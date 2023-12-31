<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerSignupRequest extends FormRequest
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
            'title'=>'required|in:mr,mrs,ms',
            'first_name'=>'required|string',
            'middle_name'=>'nullable|string',
            'last_name'=>'required|string',
            'email'=>'required|email|unique:customers',
            'contact_num'=>'required|string',
            'password'=>'required|confirmed|min:6',
            'country'=>'required|string',
            'city'=>'required|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
