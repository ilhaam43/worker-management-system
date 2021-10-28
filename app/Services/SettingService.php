<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Models\WorkerNotification;

class SettingService
{
    public function updateSetting($request, $id)
    {
            //check id setting for dynamicly notifications
            $setting = Setting::findOrFail($id);
            
            if($setting->setting_name == 'How To Work') {
                $updateHowWork = DB::table('workers_notifications')->update(['how_to_work' => 1]);
            } elseif($setting->setting_name == 'Template Message') {
                $updateMessage = DB::table('workers_notifications')->update(['message' => 1]);
            } elseif($setting->setting_name == 'Notice') {
                $updateNotice = DB::table('workers_notifications')->update(['notice' => 1]);
            } 

            $updateSetting = Setting::find($id)->update($request->all());
            return $updateSetting;
    }
}