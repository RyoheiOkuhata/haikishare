@extends('layouts.app')
@section('title', 'プロフィール')
@include('nav')
@section('content')
@include('buyers.person')
  <section class="" id="">
    <div class="l-inner__l">
      <main class="main-wrap">
        <article class="main">
          <section class="" id="">
           <div class="l-inner l-inner__m">
             <div class="c-inner--title">プロフィール編集</div>
                 <div class="l-inner--body">
                   <div class="p-login">
                    <form method="POST" action="{{route('buyers.update', ['id' =>Auth::guard('buyers')->user()]) }}"enctype="multipart/form-data" >
                      @csrf
                      <ul class="">
                    @error('buyer_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <li class="p-form--item">
                        ユーザー名
                        <p class="p-required--wrap ">
                            <span class="p-required">
                                必須
                            </span>
                        </p>
                    </li>
                        <li class="p-form--item">
                          <input id="buyer_name" type="buyer_name" class="c-text @error('buyer_name') is-invalid @enderror" name="buyer_name" value="{{ $buyer_info->buyer_name?? old('buyer_name') }}" required autocomplete="buyer_name"  placeholder="ユーザー名" >
                        </li>
                        <li class="p-form--item">
                            ひとこと
                        </li>
                        <li class="p-form--item">
                          <label for="">
                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </label>
                    <textarea name="comment"type="text" placeholder="300文字以内" class="c-textarea">{{$buyer_info->comment ?? old('comment')}}</textarea>
                        </li>
                        @error('img')
                             <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                        <li class="p-form--item">
                            プロフィール画像<br>
                            (ドラッグ&ドロップまたはクリックでアップロード)
                         </li>
                      <profile-buyer-img
                         :Idbuyer='@json([$buyer_info->img])'
                         :Isimg ='@json($is_img)'
                      ></product-buyer-img>
                      </ul>
                      <div class="submit-btn">
                    <button name="submit" type="submit"class="p-btn--submit c-btn">
                        変更する
                    </button>
                      </div>
                    </form>
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



