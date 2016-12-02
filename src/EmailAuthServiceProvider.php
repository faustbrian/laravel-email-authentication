<?php

namespace BrianFaust\EmailAuth;

use BrianFaust\ServiceProvider\ServiceProvider;

class EmailAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishConfig();

        $this->publishMigrations();

        $this->loadViews();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        parent::register();

        $this->loadRoutes();
    }

    /**
     * Get the default package name.
     *
     * @return string
     */
    public function getPackageName()
    {
        return 'email-authenticate';
    }
}
