<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\WorkerService;
use App\Http\Requests\WorkerRequest;
use App\Models\User;
use App\Models\UserStatus;
use App\Models\Worker;
use App\Models\Job;
use App\Models\Country;
use App\Models\ProductCategory;

class WorkerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $service;

    public function __construct(WorkerService $service)
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
        return view('admin.worker.index');
    }

    public function create()
    {
        $auth = Auth::user();
        $listCountries = Country::all();
        $productCategory = ProductCategory::where('id', $auth->product_category_id)->get();

        return view('admin.worker.create', compact('listCountries', 'productCategory'))->with('i');
    }

    public function store(WorkerRequest $request)
    {
        if($request['password'] !== $request['confirm_password'])
        {
            return redirect('/admin/workers/create')->with('error', 'Worker failed to add cause password and confirm password not same')->withInput();
        }

        try{    
            $store = $this->service->storeWorker($request);
        }catch(\Throwable $th){
            return redirect()->route('admin.workers.index')->with('error', 'Worker failed to add because email already registered in this system');
        }
        return redirect()->route('admin.workers.index')->with('success', 'Worker added successfully');
    }

    public function edit($id)
    {
        $worker = User::where('id', $id)->where('userable_type', 'App\Models\Worker')->first();
        $workerDetails = Worker::where('id', $worker->userable_id)->first();
        $countJobs = count(Job::where('user_id', $id)->where('job_status_id',1)->get());

        if(!$worker){
            return redirect()->route('admin.workers.index');
        }

        $usersStatus = UserStatus::all();
        $listCountries = Country::all();
        $productCategory = ProductCategory::where('id', $worker->product_category_id)->get();

        return view('admin.worker.edit', compact('worker', 'workerDetails', 'countJobs', 'usersStatus','listCountries', 'productCategory'))->with('i');
    }

    public function update(Request $request, $id)
    {
        if($request['password'] !== $request['confirm_password'])
        {
            return redirect('/admin/workers/update')->with('error', 'Worker failed to update cause password and confirm password not same');
        }

        try{    
            $update = $this->service->updateWorker($request, $id);
        }catch(\Throwable $th){
            return redirect()->route('admin.workers.index')->with('error', 'Worker failed to update because email already registered in this system');
        }
        return redirect()->route('admin.workers.index')->with('success', 'Worker update successfully');
    }

    public function destroy($id)
    {
        try{    
            $destroy = $this->service->destroyWorker($id);
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Worker data failed to delete",]);
        }
        return response()->json(['success' => true, 'message' => "Worker data deleted successfully",]);
    }
}
