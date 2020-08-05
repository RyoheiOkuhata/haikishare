<section class="" id="">
  <div class="l-inner l-inner__l">
     <div class="p-profile--body">
    @if($is_img)
      <img src="https://haiki.s3-ap-northeast-1.amazonaws.com/public/buyerProfile_images/{{$buyer_info->id}}.jpg" class="p-image__round" >
    @else
    <img class="p-image__round" src="{{ asset('imges/prof-def.png')}}">
     @endif
     <span class="p-profile--name">
      {{$buyer_info->buyer_name}}
      </span>

     </div>
     </div>
</section>



