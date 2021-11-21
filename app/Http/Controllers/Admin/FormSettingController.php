<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SettingRequest;
use App\Services\SettingService;

use App\Models\JobFormSetting;

class FormSettingController extends Controller
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
        $formSetting = JobFormSetting::where('product_category_id', $auth->product_category_id)->first();
        return view('admin.form-setting.index', compact('formSetting'));
    }

    public function update(Request $request)
    {
        $auth = Auth::user();
        $formSetting = JobFormSetting::where('product_category_id', $auth->product_category_id)->first();

        $updateUser = JobFormSetting::where('id', $formSetting->id)->update($request->except(['_token']));

        return redirect()->route('admin.form_settings.index')->with('success', 'Form settings updated successfully');
    }

}
