<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralPageRequest extends FormRequest
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
            'title'=>'required|string|unique:general_pages,title',
            'description'=>'nullable|string',
            'summary'=>'nullable|string',
            'status'=>'required',
            'image'=>'required',
            'meta_title'=>'nullable|string',
            'meta_keywords'=>'nullable|string',
            'meta_description'=>'nullable|string'
        ];
    }
}
