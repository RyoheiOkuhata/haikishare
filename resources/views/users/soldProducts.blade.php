@extends('layouts.app')
@section('title', '売却済みの全ての商品')
@include('nav')
@section('content')
@include('users.person')

  <!-- -------------------------card------------------------------->
    <section class="l-inner-wrapper__s  u-font--sub " id="Salon">
      <div class="l-inner__l font--sub">
        <main class="main-wrap">
          <article class="main">
              <div class="c-inner--title">
                売却済みの全ての商品</div>
                 <div class="p-inner__body--mypage">
                     <ul class="c-card--list__flex">
                          @foreach($soldOutProducts as $soldOutProduct)
                              <li class="p-card--article">
                                  <a href="{{ route('products.show', ['product_id' => $soldOutProduct->id]) }}">
                                    <div class="p-card--article__img">
                                      <img alt="文字表示" src="{{ asset('/storage/products_images/'.$soldOutProduct->img)}}">
                                     </div>
                                        <h2 class="p-card--article__txt">
                                             {{$soldOutProduct->product_name}}
                                        </h2>
                                   </a>
                                </li>
                            @endforeach
                        </ul>
                   </div>
                </article>
             @include('sidebar')
        </main>
        <nav class="pagination">
            {{ $soldOutProducts->links() }}
          </nav>
       </div>
    </section>
@include('footer')


