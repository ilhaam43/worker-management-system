<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\Models\Job;
use App\Models\ProductCategory;
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
                    $globalPendingWork = count(Job::where('product_category_id', $auth->product_category_id)->where('job_status_id', 3)->get());
                    
                    $categoryAdmin = ProductCategory::where('id', $auth->product_category_id)->first();

                    view()->share('globalPendingWork', $globalPendingWork);
                    view()->share('categoryAdmin', $categoryAdmin->category_name);
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
