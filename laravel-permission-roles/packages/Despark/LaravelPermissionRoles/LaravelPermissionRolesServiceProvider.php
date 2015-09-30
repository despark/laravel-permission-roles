<?php

namespace Despark\LaravelPermissionRoles;

use Illuminate\Support\ServiceProvider;
use App;

class LaravelPermissionRolesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('/migrations'),
        ], 'migrations');
    }
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
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
