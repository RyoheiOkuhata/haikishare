@extends('layouts.app')
@section('title', 'お買い求めの方新規登録')
@include('nav')
@section('content')
    <section class="l-inner--wrapper__m" id="">
      <div class="l-inner l-inner__s">

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
                <form class="c-form p-form__login" method="POST" action="{{ route('register') }}">
                    @csrf
                  <ul class="">
                 @error('shop_name')
                    <label class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </label>
                @enderror
                    <li class="p-form--item">
                        <input id="shop_name" type="shop_name" class="c-text @error('shop_name') is-invalid @enderror" name="shop_name" value="{{ old('shop_name') }}" required autocomplete="shop_name"  placeholder="コンビニ名" >
                    </li>

                @error('branch_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                    <li class="p-form--item">
                        <input id="branch_name"name="branch_name"type="text" placeholder="支店名" class="c-text" required autocomplete="branch_name" value="{{ old('branch_name') }}" >
                    </li>

                @error('prefecture')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    <li class="">
                      <li class="c-text p-form--item">
                        <select name="prefecture" id="" class="p-select">
                          <option value="">コンビニ都道府県</option>
                          @foreach($prefs as $pref )
                          <option value="{{ $pref }}">{{$pref}}</option>
                          @endforeach
                          </select>
                      </select>
                     </li>
                    </li>

                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    <li class="p-form--item">
                        <input id="address" type="address" class="c-text @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address"  placeholder="住所：市町村番地" >
                    </li>

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
                      <label class="p-validate">
                        ※半角英数字組み合わせで8文字以上
                      </label>
                    </li>

                    <li class="p-form--item">
                        <input id="password-confirm" type="password" class="c-text" name="password_confirmation"  required autocomplete="new-password"  placeholder="パスワード確認" >
                        <label for="" class="">
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









