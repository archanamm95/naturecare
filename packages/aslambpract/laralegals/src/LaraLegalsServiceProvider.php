<?php 

namespace AslamBpract\LaraLegals;

use Illuminate\Support\ServiceProvider;
use AslamBpract\LaraLegals\Commands\FooCommand;

/**
 * A Laravel 5.5 package boilerplate
 *
 * @author: Rémi Collin (remi@code16.fr)
 */
class LaraLegalsServiceProvider extends ServiceProvider {

    /**
     * This will be used to register config & view in 
     * your package namespace.
     *
     * --> Replace with your package name <--
     * 
     * @var  string
     */
    protected $packageName = 'LaraLegals';

    /**
     * A list of artisan commands for your package
     * 
     * @var array
     */
    protected $commands = [
        FooCommand::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');

        // Register Views from your package
        $this->loadViewsFrom(__DIR__.'/resources/views', $this->packageName);

        // Regiter migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Register translations
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', $this->packageName);
        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/'. $this->packageName),
        ]);

        // Register your asset's publisher
        $this->publishes([
            __DIR__.'/resources/assets' => public_path('vendor/'.$this->packageName),
        ], 'public');

        // Publish your seed's publisher
        $this->publishes([
            __DIR__.'/database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // Publish your config
        $this->publishes([
            __DIR__.'/config/config.php' => config_path($this->packageName.'.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', $this->packageName
        );

    }

}
