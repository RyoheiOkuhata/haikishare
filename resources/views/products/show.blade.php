@extends('layouts.app')
@section('title', '商品詳細')
@section('content')
@include('nav')
<section class="l-inner--wrapper__m u-bgcolor" id="">
  <div class="l-inner__m">
      <div class="l-inner l-inner__s u-border u-bgcolor__sub">
       <form method="get" action="{{route('orders.confirmShow', ['product_id' => $product->id]) }}">
           <div class="c-card--title">{{$product->product_name}}</div>
              <sold-label
              :initial-is-buyer-ordered-by='@json($order)'
              >
              </sold-label>
                  <div class="c-inner--body">
                    <ul class="">
                           <li class="">
                              <div class="p-card--img">
                                <img alt="文字表示" src="https://haiki.s3-us-west-1.amazonaws.com/{{$product->img}}">
                               </div>
                               <span class="p-card--title">価格</span>
                               <p class="p-card--txt u-font__size"><span>¥{{$product->price }}</span></p>
                               <span class="p-card--title">賞味期限</span>
                                   <p class="p-card--txt u-font__size">
                                   <span> {{$product->expiration_date}}</span>
                                    </p>

                                    <span class="p-card--title">商品の説明</span>
                                <p class="p-card--txt u-font__size">
                                    <p class="p-card--txt">{{$product->comment}}
                                    </p>
                              </li>
                      </ul>

                   <hr>
                      <ul class="u-center">
                        <h5 class="c-panel--title ">
                            <a href="{{route('userProfileDetail',[$product->user->id])}}" class="u-underline">
                                出品者の情報
                            </a>
                        </h5>
                        <ul class="p-panel--list">
                         <li class="p-panel-item">
                         @if($product->user->img)
                         <a href="{{route('userProfileDetail',[$product->user->id])}}">
                         <img src="https://haiki.s3-us-west-1.amazonaws.com/{{$user->img}}" class="p-image__round"> </a>
                        @else
                        <a href="{{route('userProfileDetail',[$product->user->id])}}">
                         <img class="p-image__round" src="{{ asset('images/prof-def.png')}}">
                        </a>
                        @endif
                          </li>

                                <li class="p-panel-item">
                                  <span class="p-card--title">お店の名前</span>
                                  </p>
                                  <p class="p-card--txt">
                                  {{$product->user->shop_name}}
                                  </p>


                                <li class="p-panel-item">
                                  <span class="p-card--title">店舗の名前</span>
                                  </p>
                                  <p class="p-card--txt">{{$product->user->branch_name}}店
                                  </p>

                                <li class="p-panel-item">
                                  <span class="p-card--title">住所</span>
                                  </p>
                                  <p class="p-card--txt">
                                  {{$product->user->prefecture}}{{$product->user->address}}</p>
                                </li>
                           </ul>

                   </ul>
                  </div>
                  <hr>
<!-- -------------------------1,user2,buyer3,ログインしていない------------------------------->

<p class="p-card--txt">
    <sns-share
     :id='@json([$product->id])'
     :name='@json([$product->product_name])'
     >
     </sns-share>
    </p>

    @if(Auth::guard('web')->user())
    <button
    class="c-btn p-btn--purchase"
    style="cursor: not-allowed"
    disabled
    >このアカウントでは購入できません
    </button>
       @elseif (Auth::guard('buyers')->user())


            <buy-btn
            :initial-is-buyer-ordered-by='@json($product->isOrderedBy(Auth::guard('buyers')->user()) )'
            :initial-is-ordered-by='@json($order)'
            >
            <buy-btn>

         @else
                    <p class="c-btn p-btn--purchase"
                        style="cursor: not-allowed"
                        disabled
                    >購入にはログインが必要です</p>
            @endif
          </form>
              </div>
             </div>
      </section>
    @include('footer')
  @endsection

