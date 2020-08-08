@csrf
<ul class="">

<li class="p-form--item">
    <input id="current-password" type="password" class="c-text @error('current-password') is-invalid @enderror" name="current-password" required autocomplete="current-password"  placeholder="現在のパスワード">
</li>

@error('new-password')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
@enderror

  <li class="p-form--item">
      <input id="new-password" type="password" class="c-text @error('new-password') is-invalid @enderror" name="new-password" required autocomplete="new-password"  placeholder="パスワード">
    <label for="" class="u-font__size">
      ※半角英数字組み合わせで8文字以上
    </label>
  </li>
  <li class="p-form--item">
    <input id="new-password-confirm" type="password" class="c-text" name="new-password_confirmation"  required autocomplete="new-password-confirm"  placeholder="パスワード確認" >
    <label for="" class="">


   <div class="submit-btn">
    <button  class="p-btn--submit c-btn">パスワードを変更する</button>
  </div>
 </ul>
