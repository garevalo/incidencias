<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    private $menu=1;
    private $submenu;

    public function boot(Request $request)
    {   
      if ($request->is('usuario') || $request->is('usuario/*')) {
        $this->menu = 1 ;
      }
      elseif($request->is('incidencia') || $request->is('incidencia/*')){
        $this->menu = 2 ;
        if($request->is('incidencia/create')){
            $this->submenu = '2.1' ;
        }
        elseif($request->is('incidencia')){
            $this->submenu = '2.2' ;
        }
      }
      view()->share(['menu'=>$this->menu,'submenu'=>$this->submenu]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
