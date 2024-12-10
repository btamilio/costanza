<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use   Illuminate\Support\Facades\Response;


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
            // it looks nice? :) 
            Response::macro('jsonPretty', function ($data = [], $status = 200, array $headers = [], $options = 0) {
                return Response::json($data, $status, $headers, JSON_PRETTY_PRINT | $options);
            });

    }
}
