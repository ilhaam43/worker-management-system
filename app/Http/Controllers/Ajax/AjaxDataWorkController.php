<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;    

use App\Models\Job;
use DataTables;

class AjaxDataWorkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function approved(Request $request)
    {
        if ($request->ajax()) {
            $auth = Auth::user();

            $data = Job::where('product_category_id', $auth->product_category_id)->where('job_status_id', 1)->with('Country', 'JobStatus', 'User')->select('jobs.*');
            
            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $editRoute = route('admin.work.edit',$data->id);
                    $actionBtn = '<a class="btn btn-primary btn-sm" href="'.$editRoute.'">Edit</a>';
    
                    return $actionBtn;
                })->addColumn('checkbox', function($data){
                    $checkbox = '<input type="checkbox" name="job_id[]" id="job_id" value="'.$data->id.'">';
                    return $checkbox;
                })->addColumn('screenshot', function($data){
                    if($data->screenshot_url == NULL){
                        $screenshotLink = 'APPROVED';
                    }else{
                        $url = asset($data->screenshot_url);
                        $screenshotLink = '<a href="'.$url.'">Screenshot</a>';
                    }

                    return $screenshotLink;
                })->addColumn('country', function($data){
                    $datas = json_decode($data, true);

                    return $datas['country']['country_name'] ?? "";
                })
                ->rawColumns(['checkbox', 'action', 'screenshot', 'country'])->setRowId(function ($data) {
                    return $data->id;
                })
                ->make(true);
        }
    }

    public function pending(Request $request)
    {
        if ($request->ajax()) {
            $auth = Auth::user();

            $data = Job::where('product_category_id', $auth->product_category_id)->where('job_status_id', 3)->with('Country', 'JobStatus', 'User')->select('jobs.*');

            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $editRoute = route('admin.work.edit',$data->id);
                    $actionBtn = '<a class="btn btn-primary btn-sm" href="'.$editRoute.'">Edit</a>';
    
                    return $actionBtn;
                })->addColumn('checkbox', function($data){
                    $checkbox = '<input type="checkbox" name="job_id[]" id="job_id" value="'.$data->id.'">';
                    return $checkbox;
                })->addColumn('screenshot', function($data){
                    if($data->screenshot_url == NULL){
                        $screenshotLink = '';
                    }else{
                        $url = asset($data->screenshot_url);
                        $screenshotLink = '<a href="'.$url.'">Screenshot</a>';
                    }

                    return $screenshotLink;
                })->addColumn('country', function($data){
                    $datas = json_decode($data, true);

                    return $datas['country']['country_name'] ?? "";
                })
                ->rawColumns(['checkbox', 'action', 'screenshot', 'country'])->setRowId(function ($data) {
                    return $data->id;
                })
                ->make(true);
        }
    }

    public function disapproved(Request $request)
    {
        if ($request->ajax()) {
            $auth = Auth::user();

            $data = Job::where('product_category_id', $auth->product_category_id)->where('job_status_id', 2)->with('Country', 'JobStatus', 'User')->select('jobs.*');
            
            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $editRoute = route('admin.work.edit',$data->id);
                    $actionBtn = '<a class="btn btn-primary btn-sm" href="'.$editRoute.'">Edit</a>';
    
                    return $actionBtn;
                })->addColumn('checkbox', function($data){
                    $checkbox = '<input type="checkbox" name="job_id[]" id="job_id" value="'.$data->id.'">';
                    return $checkbox;
                })->addColumn('screenshot', function($data){
                    if($data->screenshot_url == NULL){
                        $screenshotLink = 'DISAPPROVED';
                    }else{
                        $url = asset($data->screenshot_url);
                        $screenshotLink = '<a href="'.$url.'">Screenshot</a>';
                    }

                    return $screenshotLink;
                })->addColumn('country', function($data){
                    $datas = json_decode($data, true);

                    return $datas['country']['country_name'] ?? "";
                })
                ->rawColumns(['checkbox', 'action', 'screenshot', 'country'])->setRowId(function ($data) {
                    return $data->id;
                })
                ->make(true);
        }
    }

}