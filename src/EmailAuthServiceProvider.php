<?php



declare(strict_types=1);

namespace BrianFaust\EmailAuth;

use BrianFaust\ServiceProvider\AbstractServiceProvider;

class EmailAuthServiceProvider extends AbstractServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishConfig();

        $this->publishMigrations();

        $this->loadViews();
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        parent::register();

        $this->loadRoutes();
    }

    /**
     * Get the default package name.
     *
     * @return string
     */
    public function getPackageName(): string
    {
        return 'email-authenticate';
    }
}
