@csrf
<ul class="">
<li class="p-form--item">
<label for="">メールアドレスを入力してください</label>
</li>
<li class="p-form--item">
    <input id="email" type="email" class="c-text
    @error('email') is-invalid @enderror"
    name="email"
    @isset ($user)
    value="{{$user->email?? old('email')}}"
    @endisset
    @isset ($buyer_info)
    value="{{$buyer_info->email?? old('email')}}"
    @endisset
    required autocomplete="email"
    placeholder="メールアドレス" >
</li>
<li class="p-form--item">
<p class="">
入力されたメールアドレス宛にメールが届きます。
リンクにアクセスして変更の完了を行ってください
</p>
</li>
<div class="submit-btn">
<button  class="p-btn--submit c-btn">メールアドレスを変更する</button>
</div>
</ul>

