@extends('layouts.app')
@section('title', '商品詳細')
@section('content')
@include('nav')
<section class="l-inner--wrapper__m u-bgcolor" id="">
  <div class="l-inner__m">
      <div class="l-inner l-inner__s u-border u-bgcolor__sub">
       <form method="POST" action="{{route('orders.confirmGive', ['product_id' => $product->id]) }}">
           @csrf
           <div class="c-card--title">{{$product->product_name}}</div>
              <sold-label
              :initial-is-buyer-ordered-by='@json($order)'
              >
              </sold-label>
                <div class="c-inner--body">
                    <ul class="">
                           <li class="">
                              <div class="p-card--img">
              <img alt="文字表示" src="https://haiki.s3-ap-northeast-1.amazonaws.com/{{$product->img}}">
                               </div>
                                   <p class="p-card--txt">賞味期限 <span> {{$product->expiration_date}}</span> </p>
                                   <p class="p-card--txt">価格<span>{{$product->price}}</span> 円</p>
                              </li>
           <p class="p-card--txt">
           <sns-share
            :id='@json([$product->id])'
            :name='@json([$product->product_name])'
            >

            </sns-share>
           </p>



                      </ul>
                  </div>
<!-- -------------------------1,user2,buyer3,ログインしていない------------------------------->
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

