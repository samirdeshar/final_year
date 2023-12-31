<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'trip_id'=>'required|exists:trips,id',
            'full_name'=>'required|string',
            'email'=>'required|email',
            'phone_num'=>'required|string',
            'street_address'=>'nullable|string',
            'country'=>'required|string',
            'city'=>'nullable|string',
            'no_adults'=>'required|int',
            'no_children'=>'nullable|int',
            'passport'=>'required|string',
            'find_mega'=>'nullable',
            'travelled'=>'nullable|in:yes,no',
            'insuranced'=>'nullable|in:yes,no',
            'terms_of_use'=>'nullable|in:yes,no',
            'comments'=>'nullable|string',
            'subscribe'=>'nullable|in:yes,no',
            'member_name*'=>'nullable|string',
            'member_email*'=>'nullable|email',
            'g-recaptcha-response'=>'required',
        ];
    }
}
