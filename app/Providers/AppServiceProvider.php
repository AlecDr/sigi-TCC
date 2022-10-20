<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }

    /**
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
