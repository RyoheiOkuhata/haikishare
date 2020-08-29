<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller{

    public static function getImagePath()
    {
        return 'public/profile_images';
    }
    public static function getImageFileName()
    {
        return Auth::id() . '.jpg';
    }
}


