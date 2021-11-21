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

        if($request['company_website']){
            $checkUrl = Job::where('product_category_id', $job->product_category_id)->where('company_website', $request['company_website'])->get();
            if($request['company_website'] !== $job->company_website){
                if(count($checkUrl) > 0){
                    return error;
                }
            }
        }

        if($request['company_email']){
            $checkEmail = Job::where('product_category_id', $job->product_category_id)->where('company_email', $request['company_email'])->get();
            if($request['company_email'] !== $job->company_email){
                if(count($checkEmail) > 0){
                    return error;
                }
            }
        }
        
        if($request['link']){
            $checkLink = Job::where('product_category_id', $job->product_category_id)->where('link', $request['link'])->get();

            if($request['link'] !== $job->link){
                if(count($checkLink) > 0){
                    return error;
                }
            }
        }

        if($request['text']){
            $checkText = Job::where('product_category_id', $job->product_category_id)->where('text', $request['text'])->get();

            if($request['text'] !== $job->text){
                if(count($checkText) > 0){
                    return error;
                }
            }
        }

        if($request['name']){
            $checkName = Job::where('product_category_id', $job->product_category_id)->where('name', $request['name'])->get();

            if($request['name'] !== $job->name){
                if(count($checkName) > 0){
                    return error;
                }
            }
        }

        if($request['number']){
            $checkNumber = Job::where('product_category_id', $job->product_category_id)->where('number', $request['number'])->get();

            if($request['number'] !== $job->number){
                if(count($checkNumber) > 0){
                    return error;
                }
            }
        }

        if($request['job_status_id'] !== '3'){
            $screenshotImg = file_exists(public_path($job->screenshot_url));
            if(empty($job->screenshot_url) == 0 && $screenshotImg == 1){
                $deleteScreenshot = unlink($job->screenshot_url);
                $request['screenshot_url'] = NULL;
            }
        }

        $updateWorkData = $job->update($request->all());
        return $updateWorkData;
    }
}