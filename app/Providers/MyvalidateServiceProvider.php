<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;


class MyvalidateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('dni_ruc',function($attribute,$value,$parameters){


            $return = FALSE;

            $lenval = strlen($value);
            if( $lenval==8  || $lenval==11 )  {
                $return = TRUE;
            }    
            return $return;

        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
