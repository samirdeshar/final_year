<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'tag_id'=>'nullable|exists:post_tags,id',
            'cat_id'=>'required|exists:post_categories,id',
            'description'=>'nullable|string',
            'summary'=>'nullable|string',
            'status'=>'required|in:active,inactive',
            'image'=>'required',
            'meta-titles'=>'nullable|string',
            'meta-keywords'=>'nullable|string',
            'meta-descriptions'=>'nullable|string'
        ];
    }
}
