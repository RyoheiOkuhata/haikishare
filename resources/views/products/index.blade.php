@extends('layouts.app')
@section('title', 'Top Page')
@include('nav')
@section('content')
@include('stateMessage')


<!-- -------------------------search------------------------------->
<section class="l-inner-wrapper__s u-bgcolor__accent" id="Salon">
  <div class="l-inner__s ">
     <div class="l-inner--body">
       <h2 class="p-concept--title">詳細検索</h2>
         <div class="p-login">
           <form method="GET" action=""class="c-form p-form__login">
            <ul class="p-form--list">
              <li class="p-form--item">
               <input type="number" placeholder="価格" class="c-text" name="price_from" value="{{ old('price_from') }}">
             </li>
              <li class="p-form--item">
                 円〜
             </li>
             <li class="p-form--item">
               <input type="number" placeholder="" class="c-text" name="price_until" value="{{ old('price_until')}}">
             </li>
             <li class="p-form--item">
                 円
             </li>
            </ul>
             <ul class="p-form--list">
       
               <li class=" c-text u-border__none ">
                 <select name="prefecture" id="" class="">
                  <option value="">コンビニ都道府県</option>
                   @foreach($prefs as $pref )
                    <option value="{{ $pref }}"
                    @if(old('prefecture') === $pref) selected @endif
                    >{{$pref}}</option>
                   @endforeach
                </select>
            </li>
  
              <li class=" c-text u-border__none">
              <select name="expiration" id="">
                <option value="" >賞味期限</option>
                <option value="切れていない"
                @if(old('expiration')==='切れていない') selected  @endif
                >切れていない
              </option>
                <option value="切れている"
                @if(old('expiration')==='切れている') selected  @endif
                >切れている
              </option>
              </select>
            </li>

          </ul>
           <button class="c-btn p-btn--search">検索する</button>
      </form>
    </div>
  </div>
  </div>
  </section>
  <!-- -------------------------serch------------------------------->
<!---------------------------gallery------------------------------>
  <section class="l-inner-wrapper__s">
    <div class="l-inner">
      <div class="c-inner--body">
        <ul class="c-card--list__flex">
          @foreach($products as $product)
            @include('products.list')
           @endforeach
          </ul>
     </div>
  </div>
  </section>
<!---------------------------gallery------------------------------>

<!-- -------------------------pagination------------------------------>
<nav class="pagination">
{{ $products->appends(request()->input())->links() }}
</nav>
<!-- -------------------------pagination------------------------------>


 <!----------------------------footer------------------------------>
@include('footer')
 <!-- -------------------------footer------------------------------>
@endsection
