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
            if($id == '1') {
                $updateHowWork = DB::table('workers_notifications')->update(['how_to_work' => 1]);
            } elseif($id == '2') {
                $updateMessage = DB::table('workers_notifications')->update(['message' => 1]);
            } elseif($id == '3') {
                $updateNotice = DB::table('workers_notifications')->update(['notice' => 1]);
            } 

            $updateSetting = Setting::find($id)->update($request->all());
            return $updateSetting;
    }
}