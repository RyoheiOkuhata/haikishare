@extends('layouts.app')
@section('title', 'Haikiトップ')
@include('nav')
@section('content')
<!-- -------------------------mv------------------------------->
  <section class="p-mv">
    <div class="p-mv js-float-menu-target">
       <h1 class="p-mv--ttl">
            No more 
            <br>
            食品ロス
            <br>
            </h1>
    </div>
  </section>
<!-- -------------------------mv------------------------------->
<!-- -------------------------consept------------------------------->
  <section class="l-inner--wrapper__m" > 
    <div class="l-inner">
        <div class="c-main">
           <h1 class="c-main--title p-logo ">Haiki</h1>
        </div>
      <h2 class="c-inner--txt u-txt__accent-color">
        コンビニエンスストアと,<br>
        人をつなぐ <br>
        サービス</h2>
      </div>
    </section>
<!-- -------------------------consept------------------------------->

<!-- -------------------------work------------------------------->
    <section class="l-inner--wrapper__m u-bgcolor__accent">
      <div class="l-inner__m">
        <div class="c-main">
          <div class="p-concept">           
            <div class="c-main">
                <h2 class="c-main--title c-main--title__sub">
                  Haikiで <br>
                  みんながハッピーに</h2>
            </div>
              <p class="p-concept--txt">
                日本のコンビニエンスストアでは毎年2000トンが食品ロスとして廃棄されています。
              </p> 
              <p class="p-concept--txt">
                 本来捨ててしまうその食品を、必要としている人々の手に届けることができます。
              </p>
              <p class="p-concept--txt">
               ややこしい仕組みは一切ありません。誰もが気軽に利用できるサービスです。
              </p>
            </div>
            </div>
          </div>
    </section>
<!-- -------------------------work------------------------------->

<!-- -------------------------card------------------------------->
    <section class="l-inner--wrapper__m">
      <div class="l-inner">
         <div class="c-main">
       <h1 class="c-main--title">購買ユーザーの方の<br>サービスご利用の流れ</h1>  
        </div>
         <div class="c-inner--body">
           <ul class="c-card--list">
             <li class="p-card--item">
              <p class="p-card--item--step">STEP1</p>
              <i class="fas fa-user-plus fa-4x"></i>
             <p class="p-card--item--txt">ユーザー登録する</p> 
             </li>

            <li class="p-card--item">
             <p class="p-card--item--step">STEP2</p>
             <i class="fas fa-search fa-4x"></i>
            <p class="p-card--item--txt">商品一覧から気になる商品を探す</p> 
            </li>
   
            <li class="p-card--item">
             <p class="p-card--item--step">STEP3</p>
    
             <i class="fas fa-money-bill-alt fa-4x"></i>
            <p class="p-card--item--txt">購入ボタンを押して、相手に購入の意思を伝える</p> 
            </li>
 
            <li class="p-card--item">
             <p class="p-card--item--step">STEP4</p>
             <i class="fas fa-walking fa-4x"></i>
            <p class="p-card--item--txt">店舗に商品を購入しに行く。</p> 
            </li>
        </ul>
        

        <ul class="c-card--list p-main">
          <li class="p-main--item">
            <a href="{{ route('buyer_auth.register') }}" class="p-main--btn c-btn ">アカウントを作成する</a>
          </li>

          <li class="p-main--item">
            <a href="{{ route('buyer_auth.login')}}" class="p-main--btn c-btn ">ログインする</a>
          </li>
        </ul>
        </div>
          </div>
 
    </section>
<!-- -------------------------card------------------------------->

<!-- -------------------------------------------------------->
    <section class="l-inner--wrapper__m u-bgcolor__accent" id = "Concept"> 
      <div class="l-inner l-inner__m">
       <div class="c-main">
        <h1 class="c-main--title u-txt__color_sub p-logo
        c-main--title__sub
        ">Haiki</h1>
        </div>
      <div class="p-btn--wrapper">
        <a href="{{ route('products.index')}}" class="c-btn p-btn--go">商品を見る</a>
       </div>
  
        </div>
      </section>
  <!-- -------------------------------------------------------->
  <!-- -------------------------card------------------------------->
    <section class="l-inner--wrapper__m" id="Salon">
      <div class="l-inner">
       <div class="c-main">
       <h1 class="c-main--title">コンビニの方の<br>サービスご利用の流れ</h1>  
        </div>
         <div class="c-inner--body">
           <ul class="c-card--list">
             <li class="p-card--item">
              <p class="p-card--item--step">STEP1</p>
              <i class="fas fa-user-plus fa-4x u-fa__white"></i>
             <p class="p-card--item--txt">ユーザー登録する</p> 
             </li>
            <li class="p-card--item">
             <p class="p-card--item--step">STEP2</p>
             <i class="fas fa-check-circle fa-4x u-fa__white"></i>
            <p class="p-card--item--txt"> 廃棄となった商品を
             <br> 登録する</p> 
            </li>
            <li class="p-card--item">
             <p class="p-card--item--step">STEP3</p>
    
             <i class="fas fa-box fa-4x u-fa__white"></i>
            <p class="p-card--item--txt">メール通知が来たら商品を用意しておく。</p> 
            </li>
        </ul>
        <ul class="c-card--list p-main">
          <li class="p-main--item">
            <a href="{{ route('register')}}" class="p-main--btn c-btn ">アカウントを作成する</a>
          </li>
          <li class="p-main--item">
            <a href="{{ route('login')}}" class="p-main--btn c-btn ">ログインする</a>
          </li>
        </ul>           
        </div>
          </div>
    </section>
@include('footer')
@endsection















