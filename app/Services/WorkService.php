<?php
namespace App\Services;

use App\Models\User;
use App\Models\Job;
use App\Models\Worker;

class WorkService
{
    public function approveWork($request)
    {
        try{
            foreach($request['id'] as $id){
                $allJob = Job::whereIn('id', $request['id'])->get();

                foreach($allJob as $allJobs){
                    $screenshotImg = file_exists(public_path($allJobs->screenshot_url));
                    if($allJobs->screenshot_url !== NULL && $screenshotImg == 1){
                        $deleteScreenshot = unlink($allJobs->screenshot_url);
                    }
                }

                $approveWork = Job::find($id)->update([
                    'job_status_id' => 1,
                    'screenshot_url' => NULL,
                ]);
            }
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Job data failed to approve",]);
        }

        return response()->json(['success' => true, 'message' => "Job data success to approve",]);
    }

    public function disapproveWork($request)
    {
        try{
            foreach($request['id'] as $id){
                $allJob = Job::whereIn('id', $request['id'])->get();

                foreach($allJob as $allJobs){
                    $screenshotImg = file_exists(public_path($allJobs->screenshot_url));
                    if($allJobs->screenshot_url !== NULL && $screenshotImg == 1){
                        $deleteScreenshot = unlink($allJobs->screenshot_url);
                    }
                }

                $disapproveWork = Job::find($id)->update([
                    'job_status_id' => 2,
                    'screenshot_url' => NULL,
                ]);
            }
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Job data failed to reject",]);
        }

        return response()->json(['success' => true, 'message' => "Job data success to reject",]);
    }

    public function updateWork($request, $id)
    {
        $job = Job::find($id);
        $checkUrl = Job::where('product_category_id', $job->product_category_id)->where('company_website', $request['company_website'])->get();
        $checkEmail = Job::where('product_category_id', $job->product_category_id)->where('company_email', $request['company_email'])->get();
        
        if($request['company_website'] !== $job->company_website || $request['company_email'] !== $job->company_email){
            if(count($checkUrl) > 0){
                return error;
            }else if(count($checkEmail) > 0){
                return error;
            }
        }

        if($request['job_status_id'] !== '3'){
            $screenshotImg = file_exists(public_path($job->screenshot_url));
            if($job->screenshot_url !== NULL && $screenshotImg == 1){
                $deleteScreenshot = unlink($job->screenshot_url);
                $request['screenshot_url'] = NULL;
            }
        }

        $updateWorkData = $job->update($request->all());
        return $updateWorkData;
    }
}