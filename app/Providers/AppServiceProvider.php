<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

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
        // Listen to queries events
        // DB::listen(function ($query)
        // {
        //     dump($query->sql);
        //     dump($query->binding ?? 'no binding');
        //     dump($query->time);
        // });
    }
}
