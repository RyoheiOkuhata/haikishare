<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\PurchaseNotification;
use App\Mail\CancelNotification;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller {

//-----------------------------------------------------------
//購入画面へ
//-----------------------------------------------------------
 public function confirmShow($id) 
 {
    $product = Product::find($id);
    //商品情報
    $user = $product->user;
    //その商品を登録したユーザー情報
    $buyer = Auth::guard('buyers')->user();
    //ログインユーザー情報
    $order = $buyer->orderProduct()->where('product_id',  $id)->count();
    //$buyer->buyers()でbuyerモデルからordersテーブル経由で紐付いているproductモデルのコレクションが返る
    //ログインしているバイヤーとこの商品のidが一致しているレコードがあるかを確認

    if($order &&  $buyer)
    {
        //ログインしているのがバイヤーかつその商品をそのバイヤーが購入してたらキャンセル
        $product->orderBuyer()->detach( Auth::guard('buyers')->user()->id);
        $shop =$user;
        $buyer_name =$buyer;
        $to = [
            $shop->email,
            $buyer_name->email,
             ];
        Mail::to($to)->send(new CancelNotification($shop, $product,$buyer_name));
        return redirect()->back()->with('flash_message', '取引をキャンセルしました');
    }else{
      //ログインしているのがバイヤーでその商品が購入されていない時,購入ページに進む
      return view('orders.confirm', 
          [
          'product' => $product,
          'user' => $user,
        ]);
    }
  }

//-----------------------------------------------------------
//購入
//-----------------------------------------------------------
 public function orderDone(Request $request,$id) 
 {

   $product = Product::find($id);
    $product->orderBuyer()->detach( Auth::guard('buyers')->user()->id);
    //二重登録防止のため、一度消去
    $product->orderBuyer()->attach( Auth::guard('buyers')->user()->id);
    //$product->orders()でproductモデルからordersテーブル経由で紐付いているバイヤーモデルのコレクションが返る

    $user = $product->user;
    $buyer = Auth::guard('buyers')->user();
    $shop =$user;
    $buyer_name =$buyer;
    $to = [
        $shop->email,
        $buyer_name->email,
  ];
  Mail::to($to)->send(new PurchaseNotification($shop, $product,$buyer_name));
  return redirect()->route('products.index')->with('flash_message', '購入が完了されました');
    }
}



