<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Worker;
use App\Models\WorkerNotification;

class WorkerService
{
    public function storeWorker($request)
    {
        $storeWorker = Worker::create([
            'name' => $request['name']
        ]);

        $worker = Worker::where('name', $request['name'])->first();

        $storeUser = User::create([
                'status_id' => $request['status_id'],
                'product_category_id' =>  $request['product_category_id'],
                'name'      => $request['name'],
                'email'     => $request['email'],
                'password'  => Hash::make($request['password']),
                'country_id'   => $request['country_id'],
                'userable_type' => 'App\Models\Worker',
                'userable_id' => $worker->id
        ]);

        $getUserId = User::where('email', $request['email'])->first();

        $addWorkerNotifications = WorkerNotification::create([
                'user_id' => $getUserId->id,
                'how_to_work' => true,
                'message'    => true,
                'notice' => true
        ]);

        return $addWorkerNotifications;
    }

    public function updateWorker($request, $id)
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

    public function updateProfileWorker($request, $id)
    {
        $check = empty($request['password']);
        $user = User::find($id);

        if($check == 0){
            $request['password'] = Hash::make($request['password']);
            $updateUser = $user->update($request->except(['confirm_password']));
            return $updateUser;
        }elseif($check == 1){
            $updateUser = $user->update($request->except(['password', 'confirm_password']));
            return $updateUser;
        }
    }

    public function destroyWorker($id)
    {
        $worker = User::where('id', $id)->first();

        $destroyWorker = Worker::where('id',$worker->userable_id)->delete();
        $destroyUser  = User::where('id', $id)->delete();

        return $destroyUser;
    }
}