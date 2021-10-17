<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ProductCategory;

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
        $totalProductCategory = count(ProductCategory::all()); 
        $totalUsers = count(User::all());
        $totalAdmins = count(User::where('userable_type', 'App\Models\Admin')->get());
        $totalWorkers = count(User::where('userable_type', 'App\Models\Worker')->get());

        return view('superadmin.index', compact('totalProductCategory','totalUsers','totalAdmins','totalWorkers'));
    }
}
