@extends('layouts.app')
@section('title', 'メールアドレス変更')
@include('nav')
@section('content')
@include('buyers.person')

  <section class="" id="">
    <div class="l-inner__l">
      <main class="main-wrap">
        <article class="main">
          <section class="" id="">
           <div class="l-inner l-inner__m">
             <div class="c-inner--title">メールアドレス変更</div>
                 <div class="l-inner--body">
                   <div class="p-login">
                    @include('errMessage.errMessage')
                    <form method="POST" action="{{route('buyers.email.update', ['id' =>Auth::guard('buyers')->user()]) }}">
                      @include('emailResetForm')
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









