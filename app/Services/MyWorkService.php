<?php
namespace App\Services;

use App\Models\User;
use App\Models\Job;
use App\Models\Worker;

class MyWorkService
{
    public function storeWork($request)
    {
        if($request['company_website']){
            $urlFilter = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)/', '', $request['company_website']); //regex for filter url
            $urlFix = rtrim($urlFilter,"/");
            $checkUrl = Job::where('company_website', 'LIKE','%'.$urlFix.'%')->where('product_category_id', $request['product_category_id'])->get();

            if(count($checkUrl) > 0){
                return error;
            }
        }
        
        if($request['company_email']){
            $checkEmail = Job::where('product_category_id', $request['product_category_id'])->where('company_email', $request['company_email'])->get();

            if(count($checkEmail) > 0){
                return error;
            }
        }

        if($request['name']){
            $checkName = Job::where('product_category_id', $request['product_category_id'])->where('name', $request['name'])->get();

            if(count($checkName) > 0){
                return error;
            }
        }

        if($request['link']){
            $checkLink = Job::where('product_category_id', $request['product_category_id'])->where('link', $request['link'])->get();

            if(count($checkLink) > 0){
                return error;
            }
        }

        if($request['number']){
            $checkNumber = Job::where('product_category_id', $request['product_category_id'])->where('number', $request['number'])->get();

            if(count($checkNumber) > 0){
                return error;
            }
        }

        if($request['text']){
            $checkText = Job::where('product_category_id', $request['product_category_id'])->where('number', $request['text'])->get();

            if(count($checkText) > 0){
                return error;
            }
        }

        if($request['screenshot']){
            $name = date('YmdHis') . $request->file('screenshot')->getClientOriginalName();
            $uploadImage = $request['screenshot']->move(public_path('assets/workers/assets/img/work/'), $name);
            $request['screenshot_url'] = 'assets/workers/assets/img/work/' . $name;
        }

        $addWorkData = Job::create($request->except(['screenshot']));
        return $addWorkData;
    }

    public function updateWork($request, $id)
    {
        $job = Job::find($id);

        if($request['company_website']){
            $urlFilter = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)/', '', $request['company_website']); //regex for filter url
            $urlFix = rtrim($urlFilter,"/");
            $checkUrl = Job::where('company_website', 'LIKE','%'.$urlFix.'%')->where('product_category_id', $request['product_category_id'])->get();

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
        
        $updateWorkData = $job->update($request->all());
        return $updateWorkData;
    }
}