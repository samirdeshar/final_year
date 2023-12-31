<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripTagUpdateRequest extends FormRequest
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
            'name'=>'required|string',
            'status'=>'required|in:active,inactive',
            'description'=>'nullable|string',
            'user_id'=>'nullable|exists:users,id'
        ];
    }
}
