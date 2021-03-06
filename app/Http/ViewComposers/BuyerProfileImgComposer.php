<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class BuyerProfileImgComposer {

  public function __construct(){

}
  public function compose(View $view) {
    $buyer = Auth::guard('buyers')->user();
    $is_img = false;
  if($buyer){
  if(Auth::guard('buyers')->user() && Storage::disk('s3')->exists($buyer->img)){
    $is_img = true;
  }
  Log::debug(print_r($is_img, true));
    $view->with('is_img',$is_img);
    }
  }
 }


