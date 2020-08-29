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
                      <ul class="">
                        <h5 class="c-panel--title">購入者の情報</h5>
                        <ul class="p-panel--list">
                        <li class="p-panel-item">
                            @if($buyer->img)
                              <a href="{{ route('buyerProfileDetail', ['id' => $buyer->id])}}">
                              <img src="https://haiki.s3-us-west-1.amazonaws.com/{{$buyer->img}}" class="p-image__round"></a>
                            @else
                              <a href="{{ route('buyerProfileDetail', ['id' => $buyer->id])}}">
                              <img class="p-image__round" src="{{ asset('images/prof-def.png')}}"></a>
                             @endif
                             {{$buyer->buyer_name}}
                        </li>
                   </ul>
                  </div>
                </div>
            </div>
        </section>
    @include('footer')
  @endsection

