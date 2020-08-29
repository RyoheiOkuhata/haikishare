<section class="" id="">
  <div class="l-inner l-inner__l">
     <div class="p-profile--body">
    @if($is_img)
      <img src="https://haiki.s3-us-west-1.amazonaws.com/{{$user->img}}" class="p-image__round">
    @else
     <img class="p-image__round" src="{{ asset('images/prof-def.png')}}" srcset={{ asset('images/retina/prof-def@2x.png')}}>
     @endif
      <span class="p-profile--name">{{ $user->shop_name}}</span>
      <span class="p-profile--name">{{ $user->branch_name}} <br>支店</span>
     </div>
     </div>
</section>
