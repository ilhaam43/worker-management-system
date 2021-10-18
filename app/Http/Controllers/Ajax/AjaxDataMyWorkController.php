<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;    

use App\Models\Job;
use DataTables;

class AjaxDataMyWorkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $auth = Auth::user();

            $data = Job::where('user_id', $auth->id)->with('Country', 'JobStatus')->select('jobs.*');
            
            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $editRoute = route('worker.my-work.edit',$data->id);
                    $actionBtn = '<a class="btn btn-primary btn-sm" href="'.$editRoute.'">Edit</a>';
    
                    return $actionBtn;
                })->addColumn('screenshot', function($data){
                    if($data->screenshot_url == NULL){
                        $screenshotLink = 'DELETED';
                    }else{
                        $url = asset($data->screenshot_url);
                        $screenshotLink = '<a href="'.$url.'">Screenshot</a>';
                    }

                    return $screenshotLink;
                })
                ->rawColumns(['action', 'screenshot'])->setRowId(function ($data) {
                    return $data->id;
                })
                ->make(true);
        }
    }

}