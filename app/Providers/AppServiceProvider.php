<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

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
        if(env('FORCE_HTTPS',false)) {
            error_log('configuring https');

            $app_url = config("app.url");
            URL::forceRootUrl($app_url);
            $schema = explode(':', $app_url)[0];
            URL::forceScheme($schema);
        }

        Validator::extend('strong_password', function ($attribute, $value, $parameters, $validator) {
            // Check for at least one uppercase letter, one lowercase letter, one number, and one symbol
            return preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\_+={}[\]:,.?\/])[A-Za-z\d!@#$%^&*()\_+={}[\]:,.?\/]+$/', $value);
        });
        
        Validator::replacer('strong_password', function ($message, $attribute, $rule, $parameters) {
            return 'The password must have at least an uppercase letter, a lower case letter, a number and a symbol.';
        });
        
    }
}
