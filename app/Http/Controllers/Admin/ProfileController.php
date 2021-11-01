<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Services\AdminService;

class ProfileController extends Controller
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
        $user = Auth::user();

        return view('admin.profile', compact('user'));
    }

    public function update(Request $request)
    {
        if($request['password'] !== $request['confirm_password'])
        {
            return redirect('/admin/profile')->with('error', 'Admin failed to update cause password and confirm password not same');
        }

        $id = $request['id'];   

        try{    
            $update = $this->service->updateAdmin($request, $id);
        }catch(\Throwable $th){
            return redirect()->route('admin.profile.index')->with('error', 'Admin failed to update because email already registered in this system');
        }
        return redirect()->route('admin.profile.index')->with('success', 'Admin update successfully');
    }
}
