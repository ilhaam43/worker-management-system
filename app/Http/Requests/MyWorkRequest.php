<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MyWorkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        if(Auth::user()->userable_type == 'App\Models\Worker' || Auth::user()->userable_type == 'App\Models\Admin') {
            return true;
        }
    
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_id'            => 'required',
            'company_website'       => 'required',
            'company_email'         => 'required',
        ];
    }
}
