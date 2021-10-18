<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;
use App\Models\Worker;
use App\Models\ProductCategory;
use App\Models\Country;
use App\Models\Job;
use App\Models\Setting;
use App\Models\WorkerNotification;

class MyWorkController extends Controller
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
        $user = Auth::user();
        $listCountries = Country::all();

        $productCategory = User::where('id', $user->id)->with('ProductCategory')->get();
        $productCategories = json_decode($productCategory, true);

        $jobs = Job::where('user_id', $user->id)->with('Country', 'JobsStatus')->get();
        $jobsLists = json_decode($jobs, true);
        
        return view('worker.my-work.index', compact('jobsLists','listCountries','productCategories', 'user'))->with('i');
    }

}
