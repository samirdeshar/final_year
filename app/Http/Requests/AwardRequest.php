<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AwardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name'=>'required|string',
            'cat_id'=>'nullable|exists:team_categories,id',
            'sub_cat_id'=>'nullable|exists:team_categories,id',
            'designation'=>'nullable|string',
            'description'=>'nullable|string',
            'fb_link'=>'nullable|url',
            'twitter_link'=>'nullable|url',
            'instagram_link'=>'nullable|url',
            'status'=>'required|in:active,inactive',
            'image'=>'required'
        ];
    }
}
