<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('superadmin.worker.index');
    }

    public function create()
    {
        $listCountries = Country::all();
        $productCategory = ProductCategory::all();

        return view('superadmin.worker.create', compact('listCountries', 'productCategory'))->with('i');
    }

    public function store(WorkerRequest $request)
    {
        if($request['password'] !== $request['confirm_password'])
        {
            return redirect('/superadmin/workers/create')->with('error', 'Worker failed to add cause password and confirm password not same')->withInput();
        }

        try{    
            $store = $this->service->storeWorker($request);
        }catch(\Throwable $th){
            return redirect()->route('superadmin.workers.index')->with('error', 'Worker failed to add because email already registered in this system');
        }
        return redirect()->route('superadmin.workers.index')->with('success', 'Worker added successfully');
    }

    public function edit($id)
    {
        $worker = User::where('id', $id)->where('userable_type', 'App\Models\Worker')->first();
        $workerDetails = Worker::where('id', $worker->userable_id)->first();
        $countJobs = count(Job::where('user_id', $id)->get());

        if(!$worker){
            return redirect()->route('superadmin.workers.index');
        }

        $usersStatus = UserStatus::all();
        $listCountries = Country::all();
        $productCategory = ProductCategory::all();

        return view('superadmin.worker.edit', compact('worker', 'workerDetails', 'countJobs', 'usersStatus','listCountries', 'productCategory'))->with('i');
    }

    public function update(Request $request, $id)
    {
        if($request['password'] !== $request['confirm_password'])
        {
            return redirect('/superadmin/workers/update')->with('error', 'Worker failed to update cause password and confirm password not same');
        }

        try{    
            $update = $this->service->updateWorker($request, $id);
        }catch(\Throwable $th){
            return redirect()->route('superadmin.workers.index')->with('error', 'Worker failed to update because email already registered in this system');
        }
        return redirect()->route('superadmin.workers.index')->with('success', 'Worker update successfully');
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
