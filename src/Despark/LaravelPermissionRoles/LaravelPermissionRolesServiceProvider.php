<?php

namespace Despark\LaravelPermissionRoles;

use Illuminate\Support\ServiceProvider;

class LaravelPermissionRolesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->package('despark/laravel-permission-roles');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
