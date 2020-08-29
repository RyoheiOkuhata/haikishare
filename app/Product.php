<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = ['product_name','expiration_date','price','img',];
    //----------------------------
    //userとのリレーション(１対多)
    //----------------------------
    public function user(): BelongsTo//このメソッドの戻り値の「型」を宣言
    {
    return $this->belongsTo('App\User');
    }

    //----------------------------
    //buyerとのリレーション(多対多)
    //product->orderBuyerで自分を買ったバイヤーの情報取得
    //product->orders()->attachで中間テーブル更新
    //----------------------------
    public function orderBuyer(): BelongsToMany
    {
    return $this->belongsToMany('App\Buyer', 'orders','product_id', 'buyer_id')->withTimestamps();

    }//第二引数には中間テーブルのテーブル名

    //----------------------------
    //ログインしているバイヤーがその商品を購入済みかの確認
    //----------------------------
    public function isOrderedBy(buyer $buyer): bool 
    {
    //viewから受け取った情報がbuyerモデルであることを確認
    //返り値がboolであることを確認
      // $a =  $this->orders;
        return $buyer
             ?(bool)$this->orderBuyer->where('id', $buyer->id)->count()
             :false;
            //buyerモデルを参照して中間テーブルにアクセス。
            //ログインしているバイヤーのidをもとにordersテーブルから
            //product->buyer->orders->>where('id', $buyer->id)->count()
            //buyerモデルのコレクションが返る。
            //thisはviewから送られてきたproduct

          // $order = $buyer->buyers()->where('product_id',  $id)->count();
            //$buyer->buyers()でbuyerモデルからordersテーブル経由で紐付いているproductモデルのコレクションが返る
    }

    public function hasOrders(): HasOne//OK
{
    return $this->hasOne('App\Order');
}

}
