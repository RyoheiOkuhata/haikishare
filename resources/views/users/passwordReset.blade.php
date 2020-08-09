@extends('layouts.app')
@section('title', 'パスワードリセット')
@include('nav')
@section('content')
@include('users.person')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
  <section class="" id="">
    <div class="l-inner__l">
      <main class="main-wrap">
        <article class="main">
          <section class="" id="">
           <div class="l-inner l-inner__m">
             <div class="c-inner--title">パスワード変更</div>
                 <div class="l-inner--body">
                   <div class="p-login">
                 @include('errMessage.errMessage')
                <form method="POST" action="{{route('users.password.update', ['id' =>Auth::guard('web')->user()]) }}" >
                    @include('passwordResetForm')
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









