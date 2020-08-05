<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Buyer;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller{


public function __construct()//ポリシーを読み込む。
{
    $this->authorizeResource(Product::class, 'product');
}



//----------------------------------------
//画像登録
//---------------------------------------
public function PostImg(Request $request, Product $product){

    if (isset($request->img)) {
        //拡張子を取得
        $extension = $request->img->getClientOriginalExtension();
        //画像を第一引数で指定したディレクトリに保存する。
        //ログインしているユーザーのidと現在時間を画像の名前につけることで画像の判別を行う
        $request->img->storeAs("public/products_images", Auth::id()."_".time().".".$extension);

        //$buyer->img = $request->img->storeAs('public/products_images',$request->img, 's3');
        
    
        $product->product_name = $request->product_name;
        $product->expiration_date = $request->expiration_date;
        $product->price= $request->price;
        $product->user_id = $request->user()->id;
        //DBに保存するパスを指定する
        $product->img = (Auth::id()."_".time().".".$extension);
        return $product;
    }


}
//----------------------------------------
//一覧表示
//----------------------------------------
public function index(Request $request) {
    // Log::debug(print_r($order, true));

    //検索された値を取得
    $pref = $request->input('prefecture');
    $price_from = $request->input('price_from');
    $price_until = $request->input('price_until');
    $expiration = $request->input('expiration');
    //都道府県はconfigに別フォルダで管理
    $prefs = config('prefectures');

    //本日の日付
    $today = Carbon::today();
    //モデルをインスタンス化
    $query = new Product();

    if (isset($pref)) {
        $query = $query->whereHas('user', function ($query) use ($pref) {
            $query->where('prefecture', $pref);
        });
    }
    if (isset($expiration) && $expiration === '切れていない') {
        $query = $query->whereDate('expiration_date', '>', $today);
    }
    if (isset($expiration) && $expiration === '切れている') {
        $query = $query->whereDate('expiration_date', '<', $today);
    }
    if (isset($price_from) && isset($price_until)) {
        $query = $query->whereBetween('price', [$price_from,$price_until]);
    }

    //それぞれの条件に合ったプロパティが$queryに入る
    $products = $query->paginate(10);
    return view('products.index', [
    'products' => $products,
    'prefs' => $prefs,
    ]);
}
    // find()
    //AppModel::find(1) の返り値はModelのオブジェクト
    //get()
    //AppModel::where('id',1)->get() の返り値はCollectionクラス
    //first()
    //AppModel::where('id',1)->first() の返り値はModelのオブジェクト

//----------------------------------------
//投稿画面
//----------------------------------------
public function create() {
$user = Auth::guard('web')->user();
return view('products.create', [
    'user' => $user,
    ]);
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//----------------------------------------
//投稿
//----------------------------------------
public function store(ProductRequest $request, Product $product){

    $product = $this->PostImg($request,$product);
     //  Log::debug(print_r($product, true));
    $product->save();

return redirect()->route('users.index', ['id' => Auth::user()])->with('flash_message', '投稿が完了しました');
    }

//----------------------------------------
//詳細
//----------------------------------------
public function show(Product $product){
//この商品は購入されているかどうかのチェック。boolean型で返す
    $order = (bool)$product->orderBuyer()->count();
   //Log::debug(print_r($order, true));
    return view('products.show', [
        'product' => $product,
        'order' =>$order,
        ]);
    }

//----------------------------------------
//編集画面
//----------------------------------------
public function edit(Product $product) {
$user = Auth::guard('web')->user();
return view('products.edit', [
    'product' => $product,
    'user' => $user,
    ]);
    }
//----------------------------------------
//編集
//----------------------------------------

 public function update(Request $request, product $product) {
     Log::debug(print_r($product->img, true));
     if(isset($product->img)) {//編集の時はimgのrequiredは外す
        $request->validate([
        'product_name' => ['required','max:20'],
        'expiration_date' => 'required|date_format:"Y-m-d"|',
        'price' => 'required|numeric|',
        'img' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
     }

     //画像に変更があった時
     if (isset($request->img)) {
         $files = $product->img;
         Storage::delete("public/products_images/".$files);
         $product = $this->PostImg($request, $product);
         $product->save();
     }else{ //画像に変更がない時、または空のまま送信された時はDBは何も更新しない
        $product->product_name = $request->product_name;
        $product->expiration_date = $request->expiration_date;
        $product->price= $request->price;
        $product->save();
     }
 return redirect()->route('users.index',['id' => Auth::user()])->with('flash_message', '編集しました');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//----------------------------------------
//消去
//----------------------------------------
    public function destroy(product $product) {
        $product->delete();
        return redirect()->route('users.index',['id' => Auth::user()])->with('flash_message', '消去しました');
    }
}
