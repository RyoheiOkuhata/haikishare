@extends('layouts.app')
@section('title', '商品詳細')
@section('content')
@include('nav')
<section class="l-inner--wrapper__m u-bgcolor" id="">
  <div class="l-inner__m">
      <div class="l-inner l-inner__m u-bgcolor__sub">
                  <div class="c-inner--body">
                      <ul class="p-panel--list u-center">
                        <ul class="p-panel--list">
                         <li class="p-panel-item">
                         @if($buyer->img)
                         <a href="{{route('buyerProfileDetail',[$buyer->id])}}">
                         <img src="https://haiki.s3-us-west-1.amazonaws.com/{{$buyer->img}}" class="p-image__round-m"> </a>
                        @else
                        <a href="{{route('buyerProfileDetail',[$buyer->id])}}">
                         <img class="p-image__round-m" src="{{ asset('images/prof-def.png')}}">
                        </a>
                        @endif
                          </li>

                          <li class="p-panel-item">
                            <span class="p-card--title">ユーザーの名前</span>
                            <p class="p-card--txt">
                            {{$buyer->buyer_name}}
                            </p>
                          </li>
                          <li class="p-panel-item">
                            <span class="p-card--title">ひとこと</span>
                            <p class="p-card--txt">{{$buyer->comment}}</p>
                          </li>
                           </ul>
                       </ul>
                  </div>
            </div>
        </div>
    </div>
</section>
@include('footer')
@endsection

