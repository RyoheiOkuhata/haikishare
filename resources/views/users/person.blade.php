<section class="" id="">
  <div class="l-inner l-inner__l">
     <div class="p-profile--body">
    @if($is_img)
      <img src="/storage/userProfile_images/{{ Auth::id()}}.jpg" class="p-image__round" >
    @else
     <img class="p-image__round" src="{{ asset('imges/prof-def.png')}}">
     @endif
      <span class="p-profile--name">{{ $user->shop_name}}</span>
      <span class="p-profile--name">{{ $user->branch_name}} <br>支店</span>
     </div>
     </div>
</section>