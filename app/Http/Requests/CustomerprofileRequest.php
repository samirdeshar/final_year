<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerprofileRequest extends FormRequest
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
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'middle_name'=>'required|string',
            'country'=>'required|string',
            'city'=>'required|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
