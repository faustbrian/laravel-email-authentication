<?php

namespace BrianFaust\EmailAuth;

class ServiceProvider extends \BrianFaust\ServiceProvider\ServiceProvider
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
