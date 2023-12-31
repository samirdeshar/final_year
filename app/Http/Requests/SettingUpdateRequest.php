<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'icon'=>'sometimes',
            'logo'=>'sometimes',
            'logo2'=>'sometimes',
            'site_name'=>'string|nullable',
            'quatation'=>'string|nullable',
            'fb_link'=>'string|nullable',
            'twitter_link'=>'string|nullable',
            'linkedin_link'=>'string|nullable',
            'insta_link'=>'string|nullable',
            'youtube_link'=>'string|nullable',
            'pinterest_link'=>'string|nullable',
            'google_plus'=>'string|nullable',
            'address'=>'string|nullable',
            'location_url'=>'string|nullable',
            'email'=>'string|nullable',
            'phone'=>'string|nullable',
            'contact'=>'string|nullable',
            'contact_second'=>'string|nullable',
            'meta_title'=>'string|nullable',
            'meta_keywords'=>'string|nullable',
            'meta_description'=>'string|nullable',
        ];
    }
}
