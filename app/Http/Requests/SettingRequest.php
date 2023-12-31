<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'icon'=>'required',
            'logo'=>'required',
            'logo2'=>'required',
            'site_name'=>'string|required',
            'quatation'=>'string|required',
            'fb_link'=>'string|required',
            'twitter_link'=>'string|required',
            'linkedin_link'=>'string|required',
            'insta_link'=>'string|required',
            'youtube_link'=>'string|required',
            'pinterest_link'=>'string|required',
            'google_plus'=>'string|required',
            'address'=>'string|required',
            'location_url'=>'string|required',
            'email'=>'string|required',
            'phone'=>'string|required',
            'contact'=>'string|required',
            'contact_second'=>'string|nullable',
            'meta_title'=>'string|nullable',
            'meta_keywords'=>'string|nullable',
            'meta_description'=>'string|nullable',
        ];
    }
}
