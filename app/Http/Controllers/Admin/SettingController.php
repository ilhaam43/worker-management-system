<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use App\Services\SettingService;

use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $service;

    public function __construct(SettingService $service)
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
        $setting = Setting::all();
        return view('admin.setting.index', compact('setting'))->with('i');
    }

    public function edit($id)
    {
        $setting = Setting::find($id);
        return view('admin.setting.edit', compact('setting'));
    }

    public function update(SettingRequest $request, $id)
    {
        try{  
            $update = $this->service->updateSetting($request, $id);
        }catch(\Throwable $th){
            return back()->withError('Setting data failed to update because setting data cannot be duplicated');
        }
        return redirect()->route('admin.settings.index')->with('success', 'Settings data updated successfully');
    }
}
