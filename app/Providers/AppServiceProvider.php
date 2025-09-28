<?php

namespace App\Providers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Validator::extend('iranian_phone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(\+98|0)?9\d{9}$/', $value);
        });

        Validator::replacer('iranian_phone', function ($message, $attribute, $rule, $parameters) {
            return 'شماره تلفن وارد شده معتبر نیست!';
        });

        View::share('allTags', Tag::all());
    }
}
