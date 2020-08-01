@extends('layouts.app')
@section('title', 'ログイン')
@include('nav')
@section('content')

    <section class="l-inner--wrapper__m" id="Salon">
      <div class="l-inner l-inner__s">
       <div class="c-form--title">コンビニの方ログイン</div>
         <div class="l-inner__body">
              <div class="">
                <form method="POST" action="{{ route('login') }}">
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
                        <a href="{{ route('password.request')}}" class="p-form--item">パスワードを忘れた方</a>
                        @endif
                    </li>

        

                  </ul>
                  <div class="submit-btn">
                    <input type="submit" value="ログインする" class="p-btn--submit c-btn">
                  </div>
                </form>
              </div>
            </div>
            </div>
    </section>
    <div class="form-check">
      <input class="p-checkbox" type="checkbox" name="remember" id="remember" style="width: 10px">
    </div>
    @include('footer')
    @endsection
