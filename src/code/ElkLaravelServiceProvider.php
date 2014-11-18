<?php namespace Elk\Laravel;

use App;

class ElkLaravelServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('elk/laravel');

        if (file_exists($routesPath = (__DIR__ . '/Routes.php')))
            include $routesPath;
        if (file_exists($eventsPath = (__DIR__ . '/Events.php')))
            include $eventsPath;
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if (file_exists($bindsPath = (__DIR__ . '/Binds.php')))
            include $bindsPath;
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
