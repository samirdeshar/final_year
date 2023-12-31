<?php

namespace App\Http\Requests;

use App\Rules\TripEndRule;
use App\Rules\TripStartRule;
use Illuminate\Foundation\Http\FormRequest;

class CallBackRequest extends FormRequest
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
            'country'=>'required|string',
            'destination*'=>'required',
            'trip_type'=>'required|in:0,1',
            'trip_start'=>['required','date',new TripStartRule],
            'trip_end'=>['required','date',new TripEndRule($this->trip_start)],
            'price_range'=>'required|integer',
            'adults'=>'required|integer',
            'childs'=>'required|integer',
            'infants'=>'required|integer',
            'full_name'=>'required|string',
            'contact_num'=>'required|string',
            'email'=>'required|email',
            'g-recaptcha-response'=>'required|string'
        ];
    }
}
