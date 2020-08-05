<li class="p-card--gallery">
    <sold-label
    :initial-is-buyer-ordered-by='@json((bool)$product->orderBuyer()->where('product_id',$product->id)->count())'
    >
    </sold-label>
      <a href="{{route('products.show', ['product_id' => $product])}}">
         <div class="p-card--gallery__img">
           <p class="p-card--gallery__img">
            <img alt="文字表示" src="https://haiki.s3-ap-northeast-1.amazonaws.com/{{$product->img}}">



           </p>
          </div>
               <h2 class="p-card--gallery__txt">
                    {{$product->product_name}}
                </h2>
            </a>
            <p class="p-card--gallery__under">
                  {{$product->user->shop_name}}
           </p>
</li>
