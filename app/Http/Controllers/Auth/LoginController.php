<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
            $input = $request->all();

            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
            {
                if(auth()->user()->status_id == 2){
                    auth()->logout();
                    return back()->with('error',"Your account has been blocked please contact admin");
                }
                if (auth()->user()->userable_type == 'App\Models\SuperAdmin') {
                    return redirect('superadmin');
                }elseif (auth()->user()->userable_type == 'App\Models\Admin') {
                    return redirect('admin');
                }elseif (auth()->user()->userable_type == 'App\Models\Worker') {
                    return redirect('worker');
                }
            }else{
                return redirect('/')
                    ->with('error','Login credentials are wrong');
            }
    }
}
