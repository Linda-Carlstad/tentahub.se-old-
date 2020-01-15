<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public function boot()
     {
         if( env( 'APP_ENV' ) == 'production' )
         {
             URL::forceScheme( 'https' );
             $this->app[ 'request' ]->server->set( 'HTTPS', true );
         }
     }
}
