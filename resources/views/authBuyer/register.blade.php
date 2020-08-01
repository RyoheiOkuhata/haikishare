@extends('layouts.app')
@section('title', 'コンビニ新規登録')
@include('nav')
@section('content')

  <section class="l-inner--wrapper__m p-login-bg" id="Salon">
    <div class="l-inner l-inner__s p-login-color u-padding">
     <div class="c-form--title">アカウントを作成する</div>
     <li class="p-form--item">
        <p class="p-required--wrap ">
         <span class="p-required">
             全ての項目は必須です。
         </span>
         </p>
     </li>
       <div class="l-inner__body">
            <div class="p-login">
              <form method="POST" action="{{ route('buyer_auth.create') }}">
                @csrf
                <ul class="">

              @error('buyer_name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                  <li class="p-form--item">
                    <input id="buyer_name" type="buyer_name" class="c-text @error('buyer_name') is-invalid @enderror" name="buyer_name" value="{{ old('buyer_name') }}" required autocomplete="buyer_name"  placeholder="ユーザー名" >
                  </li>

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                  <li class="p-form--item">
                    <input id="email" type="email" class="c-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="メールアドレス" >
                  </li>

                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                  <li class="p-form--item">
                    <input id="password" type="password" class="c-text @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  placeholder="パスワード">
                    <label class="p-validate">
                      ※半角英数字組み合わせで8文字以上
                    </label>
                  </li>
                  <li class="p-form--item">
                    <input id="password-confirm" type="password" class="c-text" name="password_confirmation"  required autocomplete="new-password"  placeholder="パスワード確認" >
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
