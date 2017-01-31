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
        $this->registerRoutes();
        $this->registerMiddleware();
        $this->registerControllers();

        $this->app->bind(
            '\Jkirkby91\Boilers\NodeEntityBoiler\EntityContract',
            '\ApiArchitect\Compass\Entities\User'
        );
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
        $this->app->register(\Jkirkby91\LumenDoctrineComponent\Providers\LumenDoctrineServiceProvider::class);
        $this->app->register(\Jkirkby91\LumenRestServerComponent\Providers\LumenRestServerServiceProvider::class);
        $this->app->register(\ApiArchitect\Compass\Providers\UserRepositoryServiceProvider::class);
    }

    /**
     * Register Routes
     */
    public function registerRoutes()
    {
        require __DIR__.'/../Http/routes.php';
    }

    /**
     * Register app Middleware
     */
    public function registerMiddleware()
    {
        //
    }

     /**
      * Register Controllers + inject their transformer
      */
     public function registerControllers()
     {
         $this->app->bind(\ApiArchitect\Compass\Http\Controllers\User\UserController::class, function($app) {
             return new \ApiArchitect\Compass\Http\Controllers\User\UserController(
                 $app['em']->getRepository(\ApiArchitect\Compass\Entities\User::class),
                 new \ApiArchitect\Compass\Http\Transformers\UserTransformer
             );
         });
     }
}