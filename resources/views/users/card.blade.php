<li class="">
  <div class="p-card--img">
    <img src="/storage/profile_images/{{ Auth::id()}}.jpg">
 </div>
 <p class="p-card__txt">賞味期限<span>
{{$product->expiration_date}}
  </span> </p>
 <p class="p-card__txt">価格
    <span>
      {{$product->price }}
      </span> </p>
 </li>


