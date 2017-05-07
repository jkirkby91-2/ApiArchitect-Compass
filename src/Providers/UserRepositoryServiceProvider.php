<?php

namespace ApiArchitect\Compass\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class UserRepositoryServiceProvider
 *
 * @package ApiArchitect\Compass\Providers
 * @author James Kirkby <me@jameskirkby.com>
 */
class UserRepositoryServiceProvider extends ServiceProvider
{

    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\ApiArchitect\Compass\Repositories\UserRepository::class, function($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new \ApiArchitect\Compass\Repositories\UserRepository(
                $app['em'],
                $app['em']->getClassMetaData(\ApiArchitect\Compass\Entities\User::class)
            );
        });
    }

    /**
     * Get the services provided by the provider since we are deferring load.
     *
     * @return array
     */
    public function provides()
    {
        return ['ApiArchitect\Compass\Repositories\UserRepository'];
    }
}