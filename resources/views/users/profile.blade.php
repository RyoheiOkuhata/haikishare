@extends('layouts.app')
@section('title', 'プロフィール')
@include('nav')
@section('content')
@include('users.person')




  <section class="" id="">
    <div class="l-inner__l">
      <main class="main-wrap">
        <article class="main">
          <section class="" id="">
           <div class="l-inner l-inner__m">
             <div class="c-inner--title">プロフィール編集</div>
                 <div class="l-inner--body">
                   <div class="p-login">

                    <form method="POST" action="{{route('users.update', ['id' =>Auth::guard('web')->user()]) }}"enctype="multipart/form-data" >
                      @csrf
                    <ul class="">
                        <li class="p-form--item">
                            お店の名前
                        <p class="p-required--wrap ">
                            <span class="p-required">
                                必須
                            </span>
                        </p>
                        </li>
                @error('shop_name')
                        <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                        </span>
                  @enderror

                      <li class="p-form--item">
                          <input id="shop_name" type="shop_name" class="c-text @error('shop_name') is-invalid @enderror" name="shop_name" value="{{ $user->shop_name?? old('shop_name')}}" required autocomplete="shop_name"  placeholder="コンビニ名" >
                      </li>


                <li class="p-form--item">
                    支店名
                    <p class="p-required--wrap ">
                        <span class="p-required">
                            必須
                        </span>
                    </p>
                </li>
                  @error('branch_name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                      <li class="p-form--item">
                          <input id="branch_name"name="branch_name"type="text" placeholder="支店名" class="c-text" required autocomplete="branch_name" value="{{ $user->branch_name?? old('branch_name')}}" >
                      </li>


                    <li class="p-form--item">
                        都道府県
                        <p class="p-required--wrap ">
                            <span class="p-required">
                                必須
                            </span>
                        </p>
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
                          <option value="{{$pref}}"@if( $user->prefecture ===$pref) selected @endif>{{$pref}}</option>
                            @endforeach
                            </select>
                        </select>
                       </li>
                      </li>

                    <li class="p-form--item">
                        住所
                        <p class="p-required--wrap ">
                            <span class="p-required">
                                必須
                            </span>
                        </p>
                    </li>
                  @error('address')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                      <li class="p-form--item">
                          <input id="address" type="address" class="c-text @error('address') is-invalid @enderror" name="address" value="{{ $user->address?? old('address')}}" required autocomplete="address"  placeholder="住所：市町村番地" >
                      </li>



                 <li class="p-form--item">
                    プロフィール画像
                 </li>
                  @error('img')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                      <profile-img
                         :Iduser='@json([$user->img])'
                         :Isimg ='@json($is_img)'
                      ></profile-img>
                  </ul>
                     <div class="submit-btn">
                      <button name="submit" type="submit"class="p-btn--submit c-btn">
                        プロフィールを編集する
                      </button>
                      </div>
                     </ul>
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



