<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * 
     *
     * @var array
     */
    protected $policies = [
        'App\Imovel' => 'App\Policies\ImovelPolicy',
        'App\Model'  => 'App\Policies\ModelPolicy',
    ];

    /**
     * 
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage_imovel', function () {
            return auth()->check();
        });
    }
}
