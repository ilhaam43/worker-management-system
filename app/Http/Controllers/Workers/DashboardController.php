<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Country;
use App\Models\Job;
use App\Models\Setting;
use App\Models\WorkerNotification;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $auth = Auth::user();
        $howWeWork = Setting::where('id', 1)->first();
        
        $updateWeWork = WorkerNotification::where('user_id', $auth->id)->update(['how_we_work' => 0]);

        return view('worker.index', compact('howWeWork'));
    }
}
