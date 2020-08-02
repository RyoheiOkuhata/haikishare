<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\ProfileImgComposer;
use App\Http\ViewComposers\BuyerProfileImgComposer;


class ProfileImgServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composers([
            ProfileImgComposer::class => '*',
            BuyerProfileImgComposer::class => '*',
        ]);
    }
}

