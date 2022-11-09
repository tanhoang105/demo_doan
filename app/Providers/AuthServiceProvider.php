<?php

namespace App\Providers;

use App\Models\ChoPhep;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if(! $this->app->runningInConsole()){

            foreach (ChoPhep::all() as $chophep){
//                echo '<pre>';
//                echo $chophep;
//                $v['cols'] = $chophep->ten;
//                dd($v);
                Gate::define($chophep->ten , function ($user) use ($chophep){
//
                    return $user->HasVaiTro($chophep);
                });
            }

        }
    }
}
