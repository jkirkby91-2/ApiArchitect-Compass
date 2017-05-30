<?php

namespace ApiArchitect\Compass\Providers;

/**
 * Class CompassServiceProvider
 *
 * @package ApiArchitect\Compass\Providers
 * @author James Kirkby <me@jameskirkby.com>
 */
class CompassServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServiceProviders();
    }

    /**
     * Boot Method
     */
    public function boot()
    {
    }

    /**
     * Register dependency service provider
     */
    public function registerServiceProviders()
    {
        $this->app->register(\Jkirkby91\LumenDoctrineComponent\Providers\LumenDoctrineServiceProvider::class);
        $this->app->register(\Jkirkby91\LumenRestServerComponent\Providers\LumenRestServerServiceProvider::class);
    }
}