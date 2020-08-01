@extends('layouts.app')

@section('title', 'ユーザー登録')

@include('nav')

@section('content')
    <section class="l-inner--wrapper__m" id="">

        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
      <div class="l-inner l-inner__s">
       <div class="c-form--title">パスワード用メール送信</div>
         <div class="l-inner__body">
              <div class="p-login">
                    <form method="POST" action="{{ route('buyer_auth.password.email') }}" class="c-form p-form__login" >
                    @csrf
                  <ul class="">
        
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    <li class="p-form--item">
                        <input id="email" type="text" class="c-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="メールアドレス" >
                    </li>  
                  </ul>
        
                  <div class="submit-btn">
                    <input type="submit" value="パスワード用メール送信" class="p-btn--submit c-btn">
                  </div>
  
  
                </form>
              </div>
            </div>
            </div>
     
  
  
    </section>
  
  
  
  


  
  
  
  
  
  
  

    @include('footer')

  
    @endsection
    








