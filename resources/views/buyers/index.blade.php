@extends('layouts.app')
@section('title', 'マイページ')
@include('nav')
@section('content')
@include('buyers.person')
  <!-- -------------------------card------------------------------->
    <section class="u-font--sub " id="Salon">
      <div class="l-inner__l font--sub">
        <main class="main-wrap">
          <article class="main">
              <div class="c-inner--title">
                買った商品</div>
                  <div class="p-inner__body--mypag">
                     <ul class="c-card--list__flex">
                          @foreach($products as $product)
                              <li class="p-card--soldproduct">
                                  <a href="{{ route('products.show', ['product_id' => $product->id]) }}">
                                    <div class="p-card--article__img">
                                        <img alt="文字表示" src="https://haiki.s3-us-west-1.amazonaws.com/{{$product->img}}">
                                     </div>
                                        <h2 class="p-card--article__txt">
                                             {{$product->product_name}}
                                        </h2>
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
@endsection





