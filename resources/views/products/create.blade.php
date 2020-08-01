@extends('layouts.app')
@section('title', '商品登録')
@include('nav')
@section('content')
@include('users.person')

  <section class="" id="">
    <div class="l-inner__l">
      <main class="main-wrap">
        <article class="main">
          <section class="" id="">
           <div class="l-inner l-inner__m">
                  <div class="c-inner--title">出品する</div>
                      <div class="l-inner--body">
                            <div class="p-login">
                              <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" >
                                @csrf
                                @include('products.form')
                              <product-img
                              :Isimg =@json(false)
                              >
                              </product-img>
                                <div class="submit-btn">
                                     <button name="submit" type="submit"class="p-btn--submit c-btn">
                                       出品する
                                     </button>
                                 </div>
                               </form>
                         </div>
                    </div>
                </div>
               </section>
              </article>
            @include('sidebar')
          </main>
        </div>
     </section>
   @include('footer')
@endsection












