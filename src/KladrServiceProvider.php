<?php

namespace Kladr;

use Illuminate\Support\ServiceProvider;

class KladrServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
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
            return new Kladr( $app[ 'config' ][ 'kladr' ] );
        } );
    }
}
