<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
            'title'=>'required|string',
            'description'=>'required|string|max:800',
            'status'=>'required|string',
            'image'=>'required',

            //featured of testimonial
            'name'=>'nullable|string',
            'email'=>'nullable|string',
            'phone'=>'nullable|string',
            'address'=>'nullable|string',
            'trip'=>'nullable|string',
            'country'=>'nullable|string',
            'website'=>'nullable|string',
        ];
    }
}
