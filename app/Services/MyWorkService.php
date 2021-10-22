<?php
namespace App\Services;

use App\Models\User;
use App\Models\Job;
use App\Models\Worker;

class MyWorkService
{
    public function storeWork($request)
    {
        $urlFilter = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)/', '', $request['company_website']); //regex for filter url
        $urlFix = rtrim($urlFilter,"/");
        $checkUrl = Job::where('company_website', 'LIKE','%'.$urlFix.'%')->where('product_category_id', $request['product_category_id'])->get();
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
        $job = Job::find($id);
        $urlFilter = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)/', '', $request['company_website']); //regex for filter url
        $urlFix = rtrim($urlFilter,"/");
        $checkUrl = Job::where('company_website', 'LIKE','%'.$urlFix.'%')->where('product_category_id', $request['product_category_id'])->get();
        $checkEmail = Job::where('product_category_id', $job->product_category_id)->where('company_email', $request['company_email'])->get();
        
        if($request['company_website'] !== $job->company_website || $request['company_email'] !== $job->company_email){
            if(count($checkUrl) > 0){
                return error;
            }else if(count($checkEmail) > 0){
                return error;
            }
        }
        
        $updateWorkData = $job->update($request->all());
        return $updateWorkData;
    }
}