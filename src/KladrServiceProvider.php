<?php

namespace Kladr;

use Illuminate\Support\ServiceProvider;

class KladrServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes( [
                              __DIR__ . '/../config/kladr.php' => config_path( 'kladr.php' ),
                          ], 'kladr' );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__ . '/../config/kladr.php', 'kladr' );

        $this->app->singleton( Kladr::class, function ( $app )
        {
            return new Kladr();
        } );

        $this->app->alias( Kladr::class, 'kladr' );
    }

    public function provides()
    {
        return [ 'kladr' ];
    }
}
