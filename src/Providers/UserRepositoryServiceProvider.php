<?php

namespace ApiArchitect\Compass\Providers;

use ApiArchitect\Compass\Entities\User;
use Illuminate\Support\ServiceProvider;
use ApiArchitect\Compass\Repositories\UserRepository;

/**
 * Class AppServiceProvider
 *
 * @package app\Providers
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
        $this->app->bind(UserRepository::class, function($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new UserRepository(
                $app['em'],
                $app['em']->getClassMetaData(User::class)
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