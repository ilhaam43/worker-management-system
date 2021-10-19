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
        
        $updateWeWork = WorkerNotification::where('user_id', $auth->id)->update(['how_to_work' => 0]);

        return view('worker.index', compact('howWeWork'));
    }

    public function showMessage()
    {
        $auth = Auth::user();
        $message = Setting::where('id', 4)->first();

        $updateMessage = WorkerNotification::where('user_id', $auth->id)->update(['message' => 0]);

        return view('worker.message', compact('message'));
    }

    public function showNotice()
    {
        $auth = Auth::user();
        $researchNotice = Setting::where('id', 7)->first();

        $updateNotice = WorkerNotification::where('user_id', $auth->id)->update(['notice' => 0]);

        return view('worker.notice', compact('researchNotice'));
    }

    public function showPayments()
    {
        $auth = Auth::user();
        $worker = Worker::where('id', $auth->userable_id)->first();

        $jobQuantity = count(Job::where('user_id', $auth->id)->get());
        $jobPaid = $worker->quantity_jobs_paid;
        $amountPaid = $worker->amount_paid;

        return view('worker.payments', compact('jobQuantity', 'jobPaid', 'amountPaid'));
    }

    public function showQuantity()
    {
        $userId = Auth::user()->id;
        
        $jobApproved = count(Job::where('user_id', $userId)->where('job_status_id', 1)->get());
        $jobPending = count(Job::where('user_id', $userId)->where('job_status_id', 3)->get());
        $jobDisapproved = count(Job::where('user_id', $userId)->where('job_status_id', 2)->get());

        return view('worker.quantity', compact('jobApproved', 'jobPending', 'jobDisapproved'));
    }
}
