@extends('layouts.app')
@section('title', '商品詳細')
@section('content')
@include('nav')

<section class="l-inner--wrapper__m u-bgcolor">
    <div class="l-inner__m u-bgcolor__sub">
       <div class="c-main">
     <h1 class="c-main--title">ご購入の流れ</h1>
      </div>
       <div class="c-inner--body l-inner--wrapper__m">
         <ul class="c-card--list">

          <li class="p-card--item">
           <p class="p-card--item--step">STEP1</p>

           <i class="fas fa-money-bill-alt fa-4x"></i>
          <p class="p-card--item--txt">ご購入内容を確認して購入ボタンを押す。</p>
          </li>

          <li class="p-card--item">
            <p class="p-card--item--step">STEP2</p>

            <i class="fas fa-money-bill-alt fa-4x"></i>
           <p class="p-card--item--txt">登録しているメールアドレスにメールが届きます。</p>
           </li>

          <li class="p-card--item">
           <p class="p-card--item--step">STEP3</p>
           <i class="fas fa-walking fa-4x"></i>
          <p class="p-card--item--txt">以下店舗に商品を受け取りに行く。</p>
          </li>
      </ul>

      </div>

      <hr>
      <section class="l-inner--wrapper__m">
      <div class="l-inner l-inner__s u-bgcolor__sub">
        <div class="c-main">
            <h1 class="c-main--title">購入する商品</h1>
             </div>
        <div class="c-card--title">{{$product->product_name}}</div>

<ul class="u-center">
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
</div>
</section>

<hr>

<section class="l-inner--wrapper__m">

      <div class="l-inner l-inner__s u-bgcolor__sub">
        <div class="c-main">
            <h1 class="c-main--title">出品者</h1>
             </div>
              <div class="c-inner--body">
                <ul class="p-panel--list u-center">
                 <li class="p-panel-item">
                 @if($user->img)
                 <a href="{{route('userProfileDetail',[$user->id])}}">
                 <img src="https://haiki.s3-us-west-1.amazonaws.com/{{$user->img}}" class="p-image__round-m"> </a>
                @else
                <a href="{{route('userProfileDetail',[$user->id])}}">
                 <img class="p-image__round-m" src="{{ asset('images/prof-def.png')}}">
                </a>
                @endif
                  </li>
                  <li class="p-panel-item">
                    <span class="p-card--title">ひとこと</span>
                    </p>
                    <p class="p-card--txt">
                    {{$user->comment}}</p>
                  </li>
                        <li class="p-panel-item">
                          <span class="p-card--title">お店の名前</span>
                          </p>
                          <p class="p-card--txt">
                          {{$user->shop_name}}
                          </p>
                        </li>
                        <li class="p-panel-item">
                          <span class="p-card--title">店舗の名前</span>
                          </p>
                          <p class="p-card--txt">{{$user->branch_name}}店
                          </p>
                        </li>
                        <li class="p-panel-item">
                          <span class="p-card--title">住所</span>
                          </p>
                          <p class="p-card--txt">
                          {{$user->prefecture}}{{$user->address}}</p>
                        </li>
           </ul>
          </div>
          </div>
          <hr>

            <button
            class="c-btn p-btn--purchase js-modal-open">購入する
            </button>

</section>


</section>

        </div>

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

