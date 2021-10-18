<?php
namespace App\Services;

use App\Models\User;
use App\Models\Job;
use App\Models\Worker;

class MyWorkService
{
    public function storeWork($request)
    {
        $checkUrl = Job::where('product_category_id', $request['product_category_id'])->where('company_website', $request['company_website'])->get();
        $checkEmail = Job::where('product_category_id', $request['product_category_id'])->where('company_email', $request['company_email'])->get();
        
        if(count($checkUrl) > 0){
            return error;
        }else if(count($checkEmail) > 0){
            return error;
        }

        $name = date('YmdHis') . $request->file('screenshot')->getClientOriginalName();
        $uploadImage = $request['screenshot']->move(public_path('assets/workers/assets/img/work/'), $name);
        $request['screenshot_url'] = 'assets/workers/assets/img/work/' . $name;

        $addWorkData = Job::create($request->except(['screenshot']));
        return $addWorkData;
    }

    public function updateWork($request, $id)
    {
        $check = empty($request['password']);
        $user = User::find($id);

        if($check == 0){
            $request['password'] = Hash::make($request['password']);
            $updateWorker = Worker::find($user->userable_id)->update($request->only(['quantity_jobs_paid', 'amount_paid']));
            $updateUser = $user->update($request->except(['quantity_jobs_paid', 'amount_paid']));
            return $updateUser;
        }elseif($check == 1){
            $updateWorker = Worker::find($user->userable_id)->update($request->only(['quantity_jobs_paid', 'amount_paid']));
            $updateUser = $user->update($request->except(['quantity_jobs_paid', 'amount_paid', 'password', 'confirm_password']));
            return $updateUser;
        }
    }

    public function destroyWork($id)
    {
        $worker = User::where('id', $id)->first();

        $destroyWorker = Worker::where('id',$worker->userable_id)->delete();
        $destroyUser  = User::where('id', $id)->delete();

        return $destroyUser;
    }
}