<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\Models\WorkerNotification;

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
        view()->composer('*', function ($view) 
        {   if(Auth::check()){
                $auth = Auth::user();

                if($auth->userable_type == 'App\Models\Admin'){
                    
                }

                if($auth->userable_type == 'App\Models\Worker')
                {
                    $globalWorkerNotifications = WorkerNotification::where('user_id', $auth->id)->first();

                    view()->share('globalWorkerNotifications', $globalWorkerNotifications);
                }
            }
        });
    }
}
