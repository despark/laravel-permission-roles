<?php

namespace Despark\LaravelPermissionRoles;

use Illuminate\Support\ServiceProvider;

class LaravelPermissionRolesServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind('laravel-permission-roles', function ($app) {
            return new LaravelPermissionRoles();
        });
    }

    /**
     * Boot the package.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/src/migrations/' => base_path('/database/migrations'),
        ]);
    }
}
