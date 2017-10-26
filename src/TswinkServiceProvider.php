<?php

namespace TsWink;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class TswinkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->publishes([
            __DIR__.'/Config/tswink.php' => config_path('tswink.php'),
        ], 'tswink_config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \TsWink\Commands\TswinkGenerateCommand::class,
            ]);
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
            __DIR__ . '/Config/tswink.php', 'tswink'
        );
    }
}
