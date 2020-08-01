@extends('layouts.app')
@section('title','メールアドレス変更')
@include('nav')
@section('content')
@include('users.person')
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
                    <form method="POST" action="{{route('users.email.update', ['id' =>Auth::guard('web')->user()]) }}">
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









