<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Boolean;
use Carbon\Carbon;
use App\User;
use App\Product;
use App\EmailReset;
use App\Rules\Hankaku;
use App\Mail\ChangeEmail;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\ProductRequest;
use Request as PostRequest;
class UserController extends Controller {
//-----------------------------------------------------------
//ユーザが投稿した最近の記事5件
//-----------------------------------------------------------
    public function index(int $id){
        $user = User::where('id', $id)->first();
        $products = $user->products()->orderBy('id', 'DESC')->take(5)->get();
        //ユーザーと商品のリレーションから、最新の5件の商品を取得
        $soldOutProducts = $user->soldProduct;
        //hasmanythroughでusers->products->ordersテーブルをまたいでアクセス。売れた商品を取得

        if (!empty($soldOutProducts)) {
            foreach ($soldOutProducts as $soldOutProduct) {
                $product_id[] = $soldOutProduct->product_id;
            }//ordersテーブルのproduct_idカラムを全て取得
            if (!empty($product_id)) {
                $soldOutProducts = Product::whereIn('id', $product_id)->orderBy('id', 'DESC')->take(5)->get();
                //productsテーブルのからproduct_id[]の値を元に取得
            }
        }
        return view('users.index', [
            'products' => $products,
            'user' => $user,
            'soldOutProducts' => $soldOutProducts,
]);
    }

    //----------------------------------------
    //出品中の商品
    //----------------------------------------
    public function onSellProduct(int $id){
        $user = User::where('id', $id)->first();
        //$idをもとにuser情報取得
        $products = $user->products()->paginate(10);
      //user情報をもとに商品を取得

        return view('users.onSellProducts', [
        'user' => $user,
        'products' => $products,
      ]);
    }
    //----------------------------------------
    //売れた商品
    //----------------------------------------
    public function soldProduct($id) {
        $user = User::where('id', $id)->first();
        //ユーザー情報
        $soldOutProducts = $user->soldProduct()->paginate(10);
        //hasmanythroughでusers->products->ordersテーブルにアクセス。
        //ユーザーが出品した商品で売れたものをとる

        if (!empty($soldOutProducts)) {
            foreach ($soldOutProducts as $soldOutProduct) {
                $product_id[] = $soldOutProduct->product_id;
             }
            if (!empty($product_id)) {
                //ordersテーブルから売れた商品のproduct_idを取得
                $soldOutProducts = Product::whereIn('id',$product_id)->paginate(10);
            }
        }
        return view('users.soldProducts', [
         'soldOutProducts' => $soldOutProducts,
        'user' => $user
        ]);
    }
    //----------------------------------------
    //ユーザープロフィール編集
    //----------------------------------------
    public function profile(int $id){
        $user = User::where('id', $id)->first();
        $prefs = config('prefectures');
        return view('users.profile', [
            'user' => $user,
            'prefs' => $prefs,
        ]);
    }
    //----------------------------------------
    //ユーザープロフィール編集
    //----------------------------------------
    // GETパラメータが数字かどうかをチェックする
    public function update(UserProfileRequest $request, int $id) {
        $user = User::where('id', $id)->first();
        $user->shop_name = $request->shop_name;
        $user->branch_name = $request->branch_name;
        $user->prefecture = $request->prefecture ;
        $user->address = $request->address;
        if (!empty($request->img)) {
            Storage::delete('public/buyerProfile_images', $user->img);
            //$buyer->img = $request->img->storeAs('public/buyerProfile_images', $buyer->id . '.jpg', 's3');
            $user->img=$request->file('img')->store('public/userProfile_images', ['disk' => 's3', 'ACL' => 'public-read']);
            $user->save();
            return back()->with('flash_message', '変更が完了しました');
        }
    }
    //----------------------------------------
    //メールアドレスリセット
    //---------------------------------------
    public function emailReset(int $id){
        $user = User::where('id', $id)->first();
        $prefs = config('prefectures');
        return view('users.emailReset', [
              'user' => $user,
              'prefs' => $prefs,
          ]);
    }
    //----------------------------------------
  //メールアドレスリセット
    //---------------------------------------
    public function emailUpdate(Request $request,int $id){
        $user = User::where('id', $id)->first();
        $request->validate([
            'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($user->id)],
            ]);
            if($request->email=== $user->email) {
                return redirect()->back()->with('flash_message--failure', 'メールアドレスに変更がありません');
            }else {

                $new_email = $request->email;
                // トークン生成
                $token = hash_hmac(
                    'sha256',
                    Str::random(40) . $new_email,
                    config('app.key')
                );
                // トークンをDBに保存
                DB::beginTransaction();
                try {
                    $param = [];
                    $param['user_id'] = Auth::id();
                    $param['new_email'] = $new_email;
                    $param['token'] = $token;
                    $email_reset = EmailReset::create($param);
                    DB::commit();
                    $email_reset->sendEmailResetNotification($token);
                } catch (\Exception $e) {
                 return redirect()->back()->with('flash_message--failure ', 'メール送信に失敗しました。もう一度やり直してください');
                }
           return redirect()->back()->with('flash_message--success', 'メールを送信しました。メールアドレス変更を完了してください');
            }
      }

//----------------------------------------
  //メールアドレスリセット完了
//---------------------------------------
    public function reset(Request $request, $token){
        $email_resets = DB::table('email_resets')
            ->where('token', $token)
            ->first();
        // トークンが存在している、かつ、有効期限が切れていないかチェック
        if ($email_resets && !$this->tokenExpired($email_resets->created_at)) {

            // ユーザーのメールアドレスを更新
            $user = User::find($email_resets->user_id);
            $user->email = $email_resets->new_email;
            $user->save();

            // レコードを削除
            DB::table('email_resets')
                ->where('token', $token)
                ->delete();

             return redirect()->back()->with('flash_message--success', 'メールアドレスの更新が完了しました');
        } else {
            // レコードが存在していた場合削除
            if ($email_resets) {
                DB::table('email_resets')
                    ->where('token', $token)
                    ->delete();
            }
            return redirect()->back()->with('flash_message--failure', 'メールアドレスの更新に失敗しました。もう一度やり直してください');

        }
    }

    //----------------------------------------
    // トークンが有効期限切れかどうかチェック
    //---------------------------------------
    protected function tokenExpired($createdAt){
        // トークンの有効期限は60分に設定
        $expires = 60 * 60;
        return Carbon::parse($createdAt)->addSeconds($expires)->isPast();
    }

//----------------------------------------
//パスワードリセット
//---------------------------------------

public function passwordReset(int $id){
    $user = User::where('id', $id)->first();
    $prefs = config('prefectures');
    return view('users.passwordReset', [
          'user' => $user,
          'prefs' => $prefs,

      ]);
}
    public function passwordUpdate(Request $request,int $id)
    {
        $user = User::where('id', $id)->first();
        //現在のパスワードが正しいかを調べる
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
          return redirect()->back()->with('flash_message--failure', '現在のパスワード違います');
      }
      //現在のパスワードと新しいパスワードが違っているかを調べる
      if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
          return redirect()->back()->with('flash_message--failure', '現在のパスワードと新しいパスワードが同じです');
      }
      $request->validate([
               'new-password' => ['required','string',new Hankaku,'min:8','max:12','confirmed'],
               ]);

               $user = User::where('id', $id)->first();
               $user->password= Hash::make($request->get('new-password'));
               $user->save();
               return redirect()->back()->with('flash_message--success', 'パスワードを変更しました。次回から新しいパスワードでログインできます。');
    }

}












