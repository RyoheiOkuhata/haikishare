@extends('layouts.app')
@section('title', '商品詳細')
@section('content')
@include('nav')
<section class="l-inner--wrapper__m u-bgcolor" id="">
  <div class="l-inner__m">
      <div class="l-inner l-inner__s u-border u-bgcolor__sub">
           <div class="c-card--title">{{$product->product_name}}</div>
                <div class="c-inner--body">
                    <ul class="">
                           <li class="">
                              <div class="p-card--img">
                                <img alt="文字表示" src="https://haiki.s3-us-west-1.amazonaws.com/{{$product->img}}">
                               </div>
                                   <p class="p-card--txt">賞味期限 <span> {{$product->expiration_date}}</span> </p>
                                   <p class="p-card--txt">価格<span>{{$product->price }}</span> 円</p>
                              </li>
                      </ul>
                      <ul class="">
                        <h5 class="c-panel--title">取引先の情報</h5>
                        <ul class="p-panel--list">

                         <li class="p-panel-item">
                         @if($product->user->img)
                         <img src="https://haiki.s3-us-west-1.amazonaws.com/{{$user->img}}" class="p-image__round" >
                        @else

     <img class="p-image__round" src="{{ asset('imges/prof-def.png')}}">
                        @endif
                          </li>


                                <li class="p-panel-item">
                                  <span>お店の名前:</span>
                                  </p>
                                  <p class="p-card--txt">
                                  {{$product->user->shop_name}}店
                                  </p>


                                <li class="p-panel-item">
                                  <span>店舗の名前:</span>
                                  </p>
                                  <p class="p-card--txt">{{$product->user->branch_name}}店
                                  </p>

                                <li class="p-panel-item">
                                  <span>住所:</span>
                                  </p>
                                  <p class="p-card--txt">
                                  {{$product->user->prefecture}}{{$product->user->address}}</p>
                                </li>
                           </ul>
                   </ul>
                  </div>
                    <button
                    class="c-btn p-btn--purchase js-modal-open">購入する
                    </button>

                         <div id="app">
                         <router-view></router-view>
                       </div>
                </form>
              </div>
             </div>
      </section>


    @include('footer')



    <div class="p-modal js-modal">
        <div class="p-modal--bg js-modal-close"></div>
        <form action="{{route('orders.done', ['product_id' => $product->id]) }}" method="POST">
        <div class="p-modal--content">
          <p class="p-modal--txt">この商品を購入しますか？</p>
            @csrf
           <button class="btn p-btn--close" href="">はい</button>
          </form>
       <button class="js-modal-close btn p-btn--close" href="">戻る</button>
        </div><!--modal__inner-->
    </div><!--modal-->

  @endsection

