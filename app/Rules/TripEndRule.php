<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class TripEndRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $start;
    public function __construct($start)
    {
        $this->start=$start;
        
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->start=Carbon::parse($this->start)->format('Y-m-d');
        $end=Carbon::parse($value)->format('Y-m-d');

        if($end>=$this->start)
        {
            return true;
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute Must be Equal Or Greater Than Trip Start Date';
    }
}
