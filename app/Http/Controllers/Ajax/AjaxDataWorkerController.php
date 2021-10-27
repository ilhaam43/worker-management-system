<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;    

use App\Models\User;
use App\Models\Job;
use DataTables;

class AjaxDataWorkerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = User::where('userable_type', 'App\Models\Worker')->with(['ProductCategory', 'UserStatus', 'Country'])->select('users.*');
            
            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('actions', function($data){
                    $routeEdit = route('superadmin.workers.edit',$data->id);
                    $routeDelete = route('superadmin.workers.destroy',$data->id);

                    $actionBtn = '<a class="btn btn-primary btn-sm" href="'.$routeEdit.'">Edit</a> <button class="btn btn-danger btn-sm remove-user" data-id="'.$data->id.'" data-action="'.$routeDelete.'" onclick="deleteConfirmation('.$data->id.')"> Delete</button>';

                    return $actionBtn;
                })->addColumn('checkbox', function($data){
                    $checkbox = '<input type="checkbox" name="user_id[]" id="user_id" value="'.$data->id.'">';
                    return $checkbox;
                })->addColumn('status', function($data){
                    $datas = json_decode($data, true);

                    return $datas['user_status']['status'];
                })->addColumn('worker_quantity', function($data){
                    $job = count(Job::where('user_id', $data->id)->where('job_status_id', 1)->get());

                    return $job;
                })->addColumn('category', function($data){
                    $datas = json_decode($data, true);

                    return $datas['product_category']['category_name'] ?? '';
                })
                ->rawColumns(['actions', 'checkbox', 'status', 'category'])->setRowId(function ($data) {
                    return $data->id;
                })
                ->make(true);
        }
    }

    public function workerByCategory(Request $request)
    {
        if ($request->ajax()) {

            $auth = Auth::user();

            $data = User::where('userable_type', 'App\Models\Worker')->where('product_category_id', $auth->product_category_id)->with(['ProductCategory', 'UserStatus', 'Country'])->select('users.*');
            
            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('actions', function($data){
                    $routeEdit = route('admin.workers.edit',$data->id);
                    $routeDelete = route('admin.workers.destroy',$data->id);

                    $actionBtn = '<a class="btn btn-primary btn-sm" href="'.$routeEdit.'">Edit</a> <button class="btn btn-danger btn-sm remove-user" data-id="'.$data->id.'" data-action="'.$routeDelete.'" onclick="deleteConfirmation('.$data->id.')"> Delete</button>';

                    return $actionBtn;
                })->addColumn('checkbox', function($data){
                    $checkbox = '<input type="checkbox" name="user_id[]" id="user_id" value="'.$data->id.'">';
                    return $checkbox;
                })->addColumn('status', function($data){
                    $datas = json_decode($data, true);

                    return $datas['user_status']['status'];
                })->addColumn('worker_quantity', function($data){
                    $job = count(Job::where('user_id', $data->id)->where('job_status_id', 1)->get());

                    return $job;
                })->addColumn('category', function($data){
                    $datas = json_decode($data, true);

                    return $datas['product_category']['category_name'] ?? '';
                })
                ->rawColumns(['actions', 'checkbox', 'status', 'category'])->setRowId(function ($data) {
                    return $data->id;
                })
                ->make(true);
        }
    }

    public function blockWorkers(Request $request)
    {
        $request->validate([
            'id'   => 'required',
        ]);

        try{
            foreach($request['id'] as $id){
                $blockUsers = User::find($id)->update([
                    'status_id' => 2,
                ]);
            }
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Users data failed to block",]);
        }

        return response()->json(['success' => true, 'message' => "Users data success to block",]);
    }

}