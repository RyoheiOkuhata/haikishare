<?php
namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Buyer;
use App\EmailReset;
use App\Rules\Hankaku;


class BuyerController extends Controller {
//----------------------------------------
//バイヤーのマイページ
//----------------------------------------
public function index(int $id)
{
    $buyer = Buyer::where('id', $id)->first();
    //バイヤーと商品を紐ずけた中間テーブルから値を取得
    $products = $buyer->orderProduct()->paginate(10);
    return view('buyers.index',
    [
        'buyer_info' => $buyer,
        'products' => $products,
    ]);
}
//----------------------------------------
//プロフィール画面
//----------------------------------------
public function profile(int $id)
{
    $buyer = Buyer::where('id', $id)->first();
    return view('buyers.profile',
    [
        'buyer_info' => $buyer,
    ]);
}
//----------------------------------------
//プロフィール詳細画面
//----------------------------------------
public function profileDetail(int $id)
{
    $buyer = Buyer::where('id', $id)->first();
    return view('buyers.profileDetail',
    [
        'buyer' => $buyer,
    ]);
}

//----------------------------------------
//更新
//----------------------------------------
public function update(Request $request,int $id)
{
    $request->validate
    ([
        'buyer_name' => 'required|string|alpha_dash|max:20|',
        'img' => 'file|image|mimes:jpeg,png,jpg,gif|max:2500'
    ]);
    $buyer = Buyer::where('id', $id)->first();
    $buyer->buyer_name = $request->buyer_name;
    $buyer->comment = $request->comment;
     //s3を使わない時
    //if(!empty($request->img)) {
    //   Storage::delete('public/buyerProfile_images', $buyer->id . '.jpg');
    //   $buyer->img = $request->img->storeAs('public/buyerProfile_images', $buyer->id . '.jpg',);
    //}
    if (!empty($request->img))
    {
        Storage::delete('public/buyerProfile_images', $buyer->img);
        //s3を使わない時
        //$buyer->img = $request->img->storeAs('public/buyerProfile_images', $buyer->id . '.jpg', 's3');
        $buyer->img=$request->file('img')->store('public/buyerProfile_images', ['disk' => 's3', 'ACL' => 'public-read']);
    }
    $buyer->save();
    return back()->with('flash_message', '編集が完了しました');
}
//----------------------------------------
//メールアドレスリセット
//---------------------------------------
public function emailReset(int $id)
{
    $buyer = Buyer::where('id', $id)->first();
    return view('buyers.emailReset',
    [
        'buyer_info' => $buyer,
    ]);
}
//----------------------------------------
//確認メール送信
//---------------------------------------
public function emailResetSendEmail(Request $request,int $id)
{
$buyer = Buyer::where('id', $id)->first();
$request->validate
    ([
        'email' => ['required','string','email','max:255',Rule::unique('buyers')->ignore($buyer->id)],
    ]);

    if  ($request->email=== $buyer->email)
    {
        return redirect()->back()->with('flash_message--failure', 'メールアドレスに変更がありません');

    }else{
        $new_email = $request->email;
        // トークン生成
        $token = hash_hmac(
            'sha256',
            Str::random(40) . $new_email,
            config('app.key')
        );
        // トークンをDBに保存
        DB::beginTransaction();
    try{
            $param = [];
            $param['user_id'] = $buyer->id;
            $param['new_email'] = $new_email;
            $param['token'] = $token;
            Log::debug(print_r(      $param , true));
            $email_reset = EmailReset::create($param);
            DB::commit();
            $email_reset->BuyersendEmailResetNotification($token);
    }catch(\Exception $e)
    {
        return redirect()->back()->with('flash_message--failure ', 'メール送信に失敗しました。もう一度やり直してください');
    }
        return redirect()->back()->with('flash_message--success', 'メールを送信しました。メールアドレス変更を完了してください');
    }
}

//----------------------------------------
  //メールアドレスリセット完了
//---------------------------------------
public function emailUpdate(Request $request, $token)
{
    $email_resets = DB::table('email_resets')
        ->where('token', $token)
        ->first();

    // トークンが存在している、かつ、有効期限が切れていないかチェック
    if ($email_resets && !$this->tokenExpired($email_resets->created_at))
    {
        // ユーザーのメールアドレスを更新
        $user = Buyer::find($email_resets->user_id);
        $user->email = $email_resets->new_email;
        $user->save();
        // レコードを削除
        DB::table('email_resets')
            ->where('token', $token)
            ->delete();

            return redirect()->route('products.index')->with('flash_message', 'パスワードを変更しました');
    }else{
        // レコードが存在していた場合削除
    if  ($email_resets) {
            DB::table('email_resets')
                ->where('token', $token)
                ->delete();
        }
        return redirect()->back()->with('flash_message', 'メールアドレスの更新に失敗しました。もう一度やり直してください');

    }
}

//----------------------------------------
// トークンが有効期限切れかどうかチェック
//---------------------------------------
protected function tokenExpired($createdAt)
{
    // トークンの有効期限は60分に設定
    $expires = 60 * 60;
    return Carbon::parse($createdAt)->addSeconds($expires)->isPast();
}
//----------------------------------------
// パスワード変更
//---------------------------------------
public function passwordReset(int $id)
{
    $buyer = Buyer::where('id', $id)->first();
    return view('buyers.passwordReset', [
        'buyer_info' => $buyer,
        ]);
}
//----------------------------------------
// パスワード更新
//---------------------------------------
public function passwordUpdate(Request $request,int $id)
{
    $user = Buyer::where('id', $id)->first();
    //現在のパスワードが正しいかを調べる
    if (!(Hash::check($request->get('current-password'), $user->password)))
    {
        return redirect()->back()->with('flash_message--failure', '現在のパスワードが違います');
    }
    //現在のパスワードと新しいパスワードが違っているかを調べる
    if (strcmp($request->get('current-password'), $request->get('new-password')) === 0)
    {
        return redirect()->back()->with('flash_message--failure', '現在のパスワードと新しいパスワードが同じです');
    }
    $request->validate
    ([
        'new-password' => ['required','string',new Hankaku,'min:8','max:12','confirmed'],
    ]);
    $user = Buyer::where('id', $id)->first();
    $user->password= Hash::make($request->get('new-password'));
    $user->save();
    return redirect()->back()->with('flash_message--success', 'パスワードを変更しました。次回から新しいパスワードでログインできます。');
    }
}
