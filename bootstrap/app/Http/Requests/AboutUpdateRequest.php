<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutUpdateRequest extends FormRequest
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
            'image'=>'required',
            'slogan'=>'required',
            'background_text'=>'required',
            'status'=>'required',
            'description'=>'required',
            'meta_title'=>'nullable',
            'meta_keywords'=>'nullable',
            'meta_description'=>'nullable',
        ];
    }
}
