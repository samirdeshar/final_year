<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WhyMegaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'sub_title'=>'required',            
            'status'=>'required',            
            'meta_title'=>'required',
            'meta_keywords'=>'required',
            'meta_description'=>'required',
        ];
    }
}
