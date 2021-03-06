@extends('layouts.app')
@section('title', '出品した全ての商品')
@include('nav')
@section('content')
@include('users.person')
  <!-- -------------------------card------------------------------->
    <section class="u-font--sub " id="Salon">
      <div class="l-inner__l font--sub">
        <main class="main-wrap">
          <article class="main">
              <div class="c-inner--title">
                出品した全ての商品</div>
                 <div class="p-inner__body--mypage">
                     <ul class="c-card--list__flex">
                          @foreach($products as $product)
                              <li class="p-card--article">
                                  <a href="{{ route('products.show', ['product_id' => $product->id]) }}">
                                    <div class="p-card--article__img">

                                        <img alt="文字表示" src="https://haiki.s3-us-west-1.amazonaws.com/{{$product->img}}">
                                     </div>
                                        <h2 class="p-card--article__txt">
                                             {{$product->product_name}}
                                        </h2>
                             <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="p-card--article__link">編集/消去</a>
                                      </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </article>
             @include('sidebar')
        </main>
              <nav class="pagination">
                {{ $products->links() }}
              </nav>
       </div>

    </section>

@include('footer')


