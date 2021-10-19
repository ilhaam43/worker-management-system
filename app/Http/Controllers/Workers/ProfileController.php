<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Services\WorkerService;
use App\Models\Country;
use App\Models\User;

class ProfileController extends Controller
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
        $user = Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listCountries = Country::all();

        $id = Auth::user()->id;
        $user = User::where('id', $id)->with('Country')->first();

        return view('worker.profile', compact('user','listCountries'))->with('i');
    }

    public function update(Request $request)
    {
        if($request['password'] !== $request['confirm_password'])
        {
            return redirect('/worker/profile')->with('error', 'Worker failed to update cause password and confirm password not same');
        }

        $id = Auth::user()->id;
        
        try{    
            $update = $this->service->updateProfileWorker($request, $id);
        }catch(\Throwable $th){
            return redirect()->route('worker.profile.index')->with('error', 'Profile data failed to update');
        }
        return redirect()->route('worker.profile.index')->with('success', 'Profile data update successfully');
    }
}
