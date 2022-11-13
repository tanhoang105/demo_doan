<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class BladeService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('hasRoles', function($expression){
            if(Auth::user()){
                if(Auth::user()->hasAnyRole($expression)){
                    return 1;
                }
            }else {
             
                return 0;
            }
        });
    }
}
