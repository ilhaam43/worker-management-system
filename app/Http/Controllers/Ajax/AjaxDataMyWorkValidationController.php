<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    

use App\Models\User;
use App\Models\Job;
use DataTables;

class AjaxDataMyWorkValidationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function website(Request $request)
    {
        if($request['company_website'] == ""){
            return response()->json(['success' => false, 'empty' => true,  'message' => "Website Data Empty"], 200);
        }

        $productCategoryId = Auth::user()->product_category_id;
        $validateWebsiteData = Job::where('product_category_id', $productCategoryId)->where('company_website', $request['company_website'])->get();

        if(count($validateWebsiteData) > 0){
            return response()->json(['success' => false, 'empty' => false, 'message' => "Website Data Already Exists"], 200);
        }

        return response()->json(['success' => true, 'empty' => false, 'message' => "Website Data Is Acceptable"], 200);
    }

    public function email(Request $request)
    {
        if($request['company_email'] == ""){
            return response()->json(['success' => false, 'empty' => true,  'message' => "Email Data Empty"], 200);
        }

        $productCategoryId = Auth::user()->product_category_id;
        $validateEmailData = Job::where('product_category_id', $productCategoryId)->where('company_email', $request['company_email'])->get();

        if(count($validateEmailData) > 0){
            return response()->json(['success' => false, 'empty' => false, 'message' => "Email Data Already Exists"], 200);
        }

        return response()->json(['success' => true, 'empty' => false, 'message' => "Email Data Is Acceptable"], 200);
    }

}