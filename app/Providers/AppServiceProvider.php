<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Hash;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('correctPassword', function($attribute, $value, $parameters, $validator) {
            return Hash::check($value, $parameters[0]);
        });

        // Validator::replacer('correctPassword', function ($message, $attribute, $rule, $parameters) {
        //     return str_replace(...);
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
