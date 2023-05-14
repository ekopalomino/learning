<?php

namespace iteos\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use iteos\Models\Training;
use Auth;

class NotificationServiceProvider extends ServiceProvider
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
        View::composer('apps.includes.sidebar',function($views) {
            if(Auth::check()) {
                $views->with('training',Training::where('status','1')->count());
            }
        });
    }
}
