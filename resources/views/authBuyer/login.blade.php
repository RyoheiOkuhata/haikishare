@extends('layouts.app')
@section('title', 'お買い求めの方ログイン')
@include('nav')
@section('content')
  <section class="l-inner--wrapper__m p-login-bg" id="Salon">
    <div class="l-inner l-inner__s p-login-color u-padding">
     <div class="c-form--title">お買い求めの方ログイン</div>
       <div class="l-inner__body">
            <div class="p-login">
              <form method="POST" action="{{ route('buyer_auth.login') }}">
                @csrf
                <ul class="">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                  <li class="p-form--item">
                    <input id="email" type="email" class="c-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレス">
                  </li>
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <li class="p-form--item">
                    <input id="password" type="password" class="c-text @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  placeholder="パスワード" >
                  </li>
                  <li class="">
                  @if (Route::has('password.request'))
                          <a href="{{ route('buyer_auth.password.request')}}" class="p-form--item">パスワードを忘れた方</a>
                  @endif
                  </li>
                </ul>
                <div class="submit-btn">
                  <input type="submit" value="アカウントを作成する" class="p-btn--submit c-btn">
                </div>
              </form>
            </div>
          </div>
          </div>
  </section>
  @include('footer')
@endsection
