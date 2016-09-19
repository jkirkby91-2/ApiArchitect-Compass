<?php

namespace ApiArchitect\Compass\Providers;

use ApiArchitect\Compass\Entities\User;
use ApiArchitect\Compass\Http\Controllers\User\UserController;
use ApiArchitect\Compass\Http\Transformers\UserTransformer;
use Illuminate\Support\ServiceProvider;

/**
 * Class CompassServiceProvider
 *
 * @package ApiArchitect\Compass\Providers
 * @author James Kirkby <me@jameskirkby.com>
 */
class CompassServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->registerServiceProviders();
        $this->registerRoutes();
        $this->registerMiddleware();
        $this->registerControllers();
    }

    /**
     * Boot Method
     */
    public function boot()
    {
    }

    /**
     * Register dependancy service provider
     */
    public function registerServiceProviders()
    {
        $this->app->register(\LaravelDoctrine\ORM\DoctrineServiceProvider::class);
        $this->app->register(\Barryvdh\Cors\LumenServiceProvider::class);
        $this->app->register(\Dingo\Api\Provider\LumenServiceProvider::class);
        $this->app->register(\ApiArchitect\Compass\Providers\CompassServiceProvider::class);
        $this->app->register(\LaravelDoctrine\Extensions\GedmoExtensionsServiceProvider::class);
        $this->app->register(\ApiArchitect\Compass\Providers\NodeRepositoryServiceProvider::class);
        $this->app->register(\ApiArchitect\Compass\Providers\UserRepositoryServiceProvider::class);
    }

    /**
     * Register Routes
     */
    public function registerRoutes()
    {
        include __DIR__.'/../Http/routes.php';
    }

    /**
     * Register app Auth Middleware
     */
    public function registerMiddleware()
    {
//        $this->app['api.router']->registerMiddleware('HandleCors', \Barryvdh\Cors\HandleCors::class);
//        $this->app['api.router']->registerMiddleware('HandlePreflightSimple', \Barryvdh\Cors\HandlePreflightSimple::class);
    }

    /**
     * Register Controllers + inject their transformer
     */
    public function registerControllers()
    {
        $this->app->bind(UserController::class, function($app) {
            return new UserController(
                $app['em']->getRepository(User::class),
                new UserTransformer()
            );
        });
    }
}