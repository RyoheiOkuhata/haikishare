@extends('layouts.app')
@section('title', '商品編集')
@include('nav')
@section('content')
@include('users.person')

    <section class="l-inner--wrapper__s">
      <div class="l-inner__l">
        <main class="main-wrap">
          <article class="main">
             <section class="" id="">
               <div class="l-inner l-inner__m">
                <div class="c-inner--title">編集</div>
                      <div class="l-inner--body">
                            <div class="p-login">
                              <form method="POST" action="{{ route('products.update',['id' => $product->id]) }}" enctype="multipart/form-data" >
                                @csrf
                                @method('PATCH')
                                  @include('products.form')
                                      <product-img
                                        :Productimg ='@json([$product->img])'
                                        :Isimg =@json(true)
                                          >
                                      </product-img>
                             <div class="submit-btn">
                               <button class="p-btn--submit c-btn">編集する</button>
                              </div>
                             </form>
                             <div class="submit-btn">
                              <button  class="p-btn--delete c-btn js-modal-open">消去</button>
                               </div>
                            </div>
                         </div>
                     </div>
                  </section>
               </article>
               @include('sidebar')
           </main>
        </div>
    </section>



    <div class="p-modal js-modal">
        <div class="p-modal--bg js-modal-close"></div>
        <form method="POST" action="{{ route('products.destroy', ['product' => $product]) }}" class="form">
        <div class="p-modal--content">
          <p class="p-modal--txt">この商品を消去しますか？</p>
            @csrf
              @method('DELETE')
           <button class="btn p-btn--close" href="">はい</button>
          </form>
       <button class="js-modal-close btn p-btn--close" href="">戻る</button>
        </div>
    </div>

    <input type="file">




    @include('footer')
@endsection
