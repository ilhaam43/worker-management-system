<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\MyWorkRequest;
use App\Services\MyWorkService;
use App\Models\User;
use App\Models\Worker;
use App\Models\ProductCategory;
use App\Models\Country;
use App\Models\Job;
use App\Models\Setting;
use App\Models\WorkerNotification;
use App\Models\JobFormSetting;

class MyWorkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $service;
    
    public function __construct(MyWorkService $service)
    {
        $this->service = $service;
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

        $jobFormSetting = JobFormSetting::where('product_category_id', $user->product_category_id)->first();

        $jobs = Job::where('user_id', $user->id)->with('Country', 'JobStatus')->get();
        $jobsLists = json_decode($jobs, true);
        
        return view('worker.my-work.index', compact('jobsLists','listCountries','productCategories', 'user', 'jobFormSetting'))->with('i');
    }

    public function store(Request $request)
    {
        try{    
            $store = $this->service->storeWork($request);
        }catch(\Throwable $th){
            return redirect()->route('worker.my-work.index')->with('error', 'Work failed to add because work data cannot be duplicated');
        }
        return redirect()->route('worker.my-work.index')->with('success', 'Work added successfully');
    }

    public function edit($id)
    {
        $auth = Auth::user();
        $listCountries = Country::all();
        $listJobs = Job::where('id', $id)->with('Country', 'JobStatus')->first();
        $listForm = JobFormSetting::where('product_category_id', $auth->product_category_id)->first();

        return view('worker.my-work.edit', compact('listJobs', 'listCountries', 'listForm'))->with('i');
    }

    public function update(Request $request, $id)
    {
        try{    
            $update = $this->service->updateWork($request, $id);
        }catch(\Throwable $th){
            return back()->withError('Work data failed to update because work data cannot be duplicated');
        }
        return redirect()->route('worker.my-work.index')->with('success', 'Work data updated successfully');
    }
}
