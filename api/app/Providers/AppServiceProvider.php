<?php

namespace App\Providers;

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

    use Illuminate\Support\Facades\Schema;

    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
