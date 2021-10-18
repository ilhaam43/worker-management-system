<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\AdminService;
use App\Http\Requests\AdminRequest;
use App\Models\User;
use App\Models\UserStatus;
use App\Models\Country;
use App\Models\ProductCategory;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $service;

    public function __construct(AdminService $service)
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
        return view('superadmin.admin.index');
    }

    public function create()
    {
        $listCountries = Country::all();
        $productCategory = ProductCategory::all();

        return view('superadmin.admin.create', compact('listCountries', 'productCategory'))->with('i');
    }

    public function store(AdminRequest $request)
    {
        if($request['password'] !== $request['confirm_password'])
        {
            return redirect('/superadmin/admins/create')->with('error', 'Admin failed to add cause password and confirm password not same')->withInput();
        }

        try{    
            $store = $this->service->storeAdmin($request);
        }catch(\Throwable $th){
            return redirect()->route('superadmin.admins.index')->with('error', 'Admin failed to add because email already registered in this system');
        }
        return redirect()->route('superadmin.admins.index')->with('success', 'Admin added successfully');
    }

    public function edit($id)
    {
        $admin = User::where('id', $id)->where('userable_type', 'App\Models\Admin')->first();

        if(!$admin){
            return redirect()->route('superadmin.admins.index');
        }

        $usersStatus = UserStatus::all();
        $listCountries = Country::all();
        $productCategory = ProductCategory::all();

        return view('superadmin.admin.edit', compact('admin', 'usersStatus','listCountries', 'productCategory'))->with('i');
    }

    public function update(Request $request, $id)
    {
        if($request['password'] !== $request['confirm_password'])
        {
            return redirect('/superadmin/admins/update')->with('error', 'Admin failed to update cause password and confirm password not same');
        }

        try{    
            $update = $this->service->updateAdmin($request, $id);
        }catch(\Throwable $th){
            return redirect()->route('superadmin.admins.index')->with('error', 'Admin failed to update because email already registered in this system');
        }
        return redirect()->route('superadmin.admins.index')->with('success', 'Admin update successfully');
    }

    public function destroy($id)
    {
        try{    
            $destroy = $this->service->destroyAdmin($id);
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Admin data failed to delete",]);
        }
        return response()->json(['success' => true, 'message' => "Admin data deleted successfully",]);
    }
}
