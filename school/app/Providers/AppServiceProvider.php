<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Database\Eloquent\Relations\Relation;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Relation::morphMap([
            'App\Models\User' => 'App\Models\User',
            'App\Models\Admin' => 'App\Models\User'
        ]);
        Password::defaults(function () {
            $rule = Password::min(8);
            return $this->app->isProduction()
                ? $rule->mixedCase()->uncompromised()
                : $rule;
        });
    }
}
