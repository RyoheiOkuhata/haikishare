@extends('layouts.app')
@section('title', 'パスワード変更')
@include('nav')
@section('content')
@include('stateMessage')

    <section class="l-inner--wrapper__m" id="">
      <div class="l-inner l-inner__s">
          <div class="c-form--title">パスワード変更</div>
         <div class="l-inner__body">
              <div class="p-login">                  
                    <form method="POST" action="{{ route('buyer_auth.password.update') }}" class="c-form p-form__login" >
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                  <ul class="">
        
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    <li class="p-form--item">
                        <input id="email" type="text" class="c-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="メールアドレス" >
                    </li>  

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                <li class="p-form--item">
                    <input id="password" type="password" class="c-text @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  placeholder="パスワード">
                    <label for="" class="">
                  <label for="" class="">
                    ※半角英数字組み合わせで8文字以上
                  </label>
                </li>

                <li class="p-form--item">
                    <input id="password-confirm" type="password" class="c-text" name="password_confirmation"  required autocomplete="new-password"  placeholder="パスワード確認" >
                    <label for="" class="">
                </li>

                  </ul>
        
                  <div class="submit-btn">
                    <input type="submit" value="パスワード変更" class="p-btn--submit c-btn">
                  </div>
  
  
                </form>
              </div>
            </div>
            </div>
     
  
  
    </section>
  
  
  
  


  
  
  
  
  
  
  

    @include('footer')

  
    @endsection
    








