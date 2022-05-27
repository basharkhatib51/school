<?php

namespace App\Providers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class LocalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $lang = null;
        if (isset($_SERVER['HTTP_LOCAL'])) {
            if ($_SERVER['HTTP_LOCAL'])
                $lang = $_SERVER['HTTP_LOCAL'];
        } elseif (Auth::user()) {
            if (Auth::user()->languages == 'English')
                $lang = 'en';
            elseif (Auth::user()->languages == 'Arabic')
                $lang = 'ar';
            elseif (Auth::user()->languages == 'Turkish')
                $lang = 'tr';
            else
                $lang = config('app.locale', 'en');;
        }
        if ($lang)
            config(['app.locale' => $lang]);
    }
}
