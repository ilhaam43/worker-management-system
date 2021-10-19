<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Job;

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
        $user = Auth::user();
        $worker = count(User::where('userable_type', 'App\Models\Worker')->where('product_category_id', $user->product_category_id)->get()); 
        $totalWork = count(Job::where('product_category_id', $user->product_category_id)->get());
        $totalWorkPending = count(Job::where('product_category_id', $user->product_category_id)->where('job_status_id', 3)->get());

        return view('admin.index', compact('worker','totalWork','totalWorkPending'));
    }
}
