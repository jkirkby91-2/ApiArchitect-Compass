<?php
	declare(strict_types=1);

	namespace ApiArchitect\Compass\Providers {

		/**
		 * Class CompassServiceProvider
		 *
		 * @package ApiArchitect\Compass\Providers
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 */
		class CompassServiceProvider extends \Illuminate\Support\ServiceProvider
		{
			/**
			 * register()
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
	}