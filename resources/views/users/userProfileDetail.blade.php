@extends('layouts.app')
@section('title', '商品詳細')
@section('content')
@include('nav')
<section class="l-inner--wrapper__m u-bgcolor" id="">
  <div class="l-inner__m">
      <div class="l-inner l-inner__m u-bgcolor__sub">
           <div class="c-card--title">出品者の情報</div>
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

                  <div class="c-inner--body">
                    <div class="c-card--title">出品商品</div>
                    <ul class="c-card--list__flex">
                        @foreach($products as $product )
                        <li class="p-card--gallery">
                            <sold-label
                            :initial-is-buyer-ordered-by='@json((bool)$product->orderBuyer()->count())'
                            >
                            </sold-label>
                            <a href="{{route('products.show', ['product_id' => $product])}}">

                               <div class="p-card--gallery__img">
                                 <p class="p-card--gallery__img">
                                  <img alt="文字表示" src="https://haiki.s3-us-west-1.amazonaws.com/{{$product->img}}">
                                 </p>
                                </div>
                                     <h2 class="p-card--gallery__txt">
                                          {{$product->product_name}}
                                      </h2>
                                      <h2 class="p-card--gallery__txt">
                                          ¥{{$product->price}}
                                      </h2>
                                  </a>
                                  <p class="p-card--gallery__under">
                                        {{$product->user->prefecture}}
                                 </p>
                        </li>
                        @endforeach
                      </ul>
                      <nav class="pagination">
                        {{ $products->appends(request()->input())->links() }}
                        </nav>
                 </div>
            </div>
        </div>
    </div>
</section>
@include('footer')
@endsection








