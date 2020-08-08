<?php

namespace App\Http\ViewComposers;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ProfileImgComposer {

  public function __construct(){

  }

  public function compose(View $view) {
      $user = Auth::guard('web')->user();
      $is_img = false;
      if($user) {
      if (Auth::guard('web')->user() && Storage::disk('s3')->exists($user->img)) {
          $is_img = true;
      }
      Log::debug(print_r($is_img, true));
      $view->with('is_img',$is_img);
    }
  }
}

