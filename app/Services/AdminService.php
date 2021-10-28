<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Admin;
use App\Models\Setting;

class AdminService
{
    public function storeAdmin($request)
    {
        $storeAdmin = Admin::create([
            'name' => $request['name']
        ]);

        $admin = Admin::where('name', $request['name'])->first();

        $checkCategory = count(Setting::where('product_category_id', $request['product_category_id'])->get());

        $storeUser = User::create([
                'status_id' => $request['status_id'],
                'product_category_id' =>  $request['product_category_id'],
                'name'      => $request['name'],
                'email'     => $request['email'],
                'password'  => Hash::make($request['password']),
                'country_id'   => $request['country_id'],
                'userable_type' => 'App\Models\Admin',
                'userable_id' => $admin->id
        ]);

        if($checkCategory == 0) //create settings per product category
        {
            $createHowToWork = Setting::create([
                'product_category_id' =>  $request['product_category_id'],
                'setting_name'        => 'How To Work',
                'setting_description' => 'How To Work',
            ]);

            $createTemplateMessage = Setting::create([
                'product_category_id' =>  $request['product_category_id'],
                'setting_name'        => 'Template Message',
                'setting_description' => 'Template Message',
            ]);

            $createNotice = Setting::create([
                'product_category_id' =>  $request['product_category_id'],
                'setting_name'        => 'Notice',
                'setting_description' => 'Notice',
            ]);
        }

        return $storeUser;
    }

    public function updateAdmin($request, $id)
    {
        $check = empty($request['password']);

        if($check == 0){
            $request['password'] = Hash::make($request['password']);
            $update = User::find($id)->update($request->all());
            return $update;
        }elseif($check == 1){
            $update = User::find($id)->update($request->except(['password', 'confirm_password']));
            return $update;
        }
    }

    public function destroyAdmin($id)
    {
        $admin = User::where('id', $id)->first();

        $destroyAdmin = Admin::where('id',$admin->userable_id)->delete();
        $destroyUser  = User::where('id', $id)->delete();

        return $destroyUser;
    }
}