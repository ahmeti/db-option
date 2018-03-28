<?php 

namespace Ahmeti\DBOption\Providers;

use Illuminate\Support\ServiceProvider;
use Ahmeti\DBOption\Services\DBOption;

class DBOptionServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ahmeti-db-option', function () {
            return new DBOption();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ahmeti-db-option'];
    }
}