<ul class="">
    <li class="p-form--item">
        商品名
        <p class="p-required--wrap ">
            <span class="p-required">
                必須
            </span>
        </p>
    </li>
    <li class="p-form--item">
      <label for="">
        @error('product_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
       </label>
     <input  name="product_name"type="text" required  placeholder="商品名" class="c-text" value="{{ $product->product_name ?? old('product_name') }}" >
    </li>
    <li class="p-form--item">
        賞味期限
        <p class="p-required--wrap ">
            <span class="p-required">
                必須
            </span>
        </p>
    </li>
    <li class="p-form--item">
      <label for="">
      @error('expiration_date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
      </label>
      <input  name="expiration_date"type="date" required  placeholder="賞味期限は年-月-日の形で入力してください" class="c-text" value="{{ $product->expiration_date ?? old('expiration_date')}}">
    </li>
    <li class="p-form--item">
        価格
        <p class="p-required--wrap ">
            <span class="p-required">
                必須
            </span>
        </p>
    </li>
      <li class="p-form--item">
        <label for="">
          @error('price')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        </label>
        <i class="fas fa-yen-sign"></i>
        <input  name="price" type="number" required  placeholder="価格" class="c-text--price" value="{{ $product->price ?? old('price') }}">
      </li>


      <li class="p-form--item">
        商品の説明
        <p class="p-required--wrap ">
            <span class="p-required">
                必須
            </span>
        </p>
    </li>
    <li class="p-form--item">
      <label for="">
        @error('comment')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
       </label>
       <textarea  name="comment"type="text" required  placeholder="300文字以内" class="c-textarea">{{ $product->comment ?? old('comment') }}</textarea>
    </li>

      <li class="p-form--item">
        商品画像
        <p class="p-required--wrap">
            <span class="p-required">
                必須
            </span>
        </p>
        <p class="p-form--item u-font__size-s">(ドラッグ&ドロップまたはクリックでアップロード)</p>
    </li>
    @error('img')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror


     </ul>

