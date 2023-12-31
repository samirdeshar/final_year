<?php

namespace App\Http\Requests;

use App\Rules\TripEndRule;
use App\Rules\TripStartRule;
use Illuminate\Foundation\Http\FormRequest;

class TripBookSaveRequest extends FormRequest
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
            'trip_type'=>'required|in:0,1',
            'arrival'=>['required','date',new TripStartRule],
            'departure'=>['required','date',new TripEndRule($this->arrival)],
            'num_of_pax'=>'required|integer',
            'adults'=>'required|integer',
            'childs'=>'required|integer',
            'infants'=>'required|integer',
            'title'=>'required|in:0,1,2',
            'first_name'=>'required|string',
            'middle_name'=>'nullable|string',
            'last_name'=>'required|string',
            'contact_num'=>'required|string',
            'email'=>'required|email',
            'country'=>'required|string',
            'city'=>'required|string',
            'passport'=>'required|string',
            'additional_info'=>'required|string',
            'extra_faciulity'=>'required|string',
            'know_from'=>'required|in:0,1,2,3,4',
            'aggree'=>'required|in:1'
        ];
    }
}
