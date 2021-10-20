<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\WorkService;
use App\Models\User;
use App\Models\UserStatus;
use App\Models\Worker;
use App\Models\Job;
use App\Models\JobStatus;
use App\Models\Country;
use App\Models\ProductCategory;

class WorkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $service;

    public function __construct(WorkService $service)
    {   
        $this->service = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function approved()
    {
        return view('admin.work.approved');
    }

    public function pending()
    {
        $auth = Auth::user();
        $job = Job::where('product_category_id', $auth->product_category_id)->where('job_status_id', 3)->get();
        return view('admin.work.pending', compact('job'))->with('i');
    }

    public function disapproved()
    {
        return view('admin.work.disapproved');
    }

    public function approveWork(Request $request)
    {
        $request->validate([
            'id'   => 'required',
        ]);

        return $this->service->approveWork($request);
    }

    public function disapproveWork(Request $request)
    {
        $request->validate([
            'id'   => 'required',
        ]);

        return $this->service->disapproveWork($request);
    }

    public function edit($id)
    {
        $listCountries = Country::all();
        $jobsStatus = JobStatus::all();
        $job = Job::where('id', $id)->with('Country', 'JobStatus')->first();

        if(!$job){
            return redirect()->route('admin.work.pending');
        }

        return view('admin.work.edit', compact('job', 'listCountries', 'jobsStatus'))->with('i');
    }

    public function update(Request $request, $id)
    {
        try{    
            $update = $this->service->updateWork($request, $id);
        }catch(\Throwable $th){
            return back()->withError('Work data failed to update because work data cannot be duplicated');
        }
        return redirect()->route('admin.work.pending')->with('success', 'Work data updated successfully');
    }
}