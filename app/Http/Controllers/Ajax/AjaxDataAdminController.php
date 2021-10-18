<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;    

use App\Models\User;
use DataTables;

class AjaxDataAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = User::where('userable_type', 'App\Models\Admin')->with(['ProductCategory', 'UserStatus', 'Country', 'Userable'])->select('users.*');
                
            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('actions', function($data){
                    $routeEdit = route('superadmin.admins.edit',$data->id);
                    $routeDelete = route('superadmin.admins.destroy',$data->id);

                    $actionBtn = '<a class="btn btn-primary btn-sm" href="'.$routeEdit.'">Edit</a> <button class="btn btn-danger btn-sm remove-user" data-id="'.$data->id.'" data-action="'.$routeDelete.'" onclick="deleteConfirmation('.$data->id.')"> Delete</button>';

                    return $actionBtn;
                })->addColumn('checkbox', function($data){
                    $checkbox = '<input type="checkbox" name="user_id[]" id="user_id" value="'.$data->id.'">';
                    return $checkbox;
                })->addColumn('status', function($data){
                    $datas = json_decode($data, true);

                    return $datas['user_status']['status'];
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

}