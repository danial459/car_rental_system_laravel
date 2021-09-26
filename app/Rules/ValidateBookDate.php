<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class ValidateBookDate implements Rule
{
    protected $date1,$time1,$date2;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date1,$time1,$date2)
    {
        $this->date1 = $date1;
        $this->time1 = $time1;
        $this->date2 = $date2;
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
        $time2 = $value;

        $now = Carbon::now();

        if ( !$this->date1 or !$this->time1 or !$this->date2 ) {
            return back();
       }


        $input_start_date = $this->date1.substr($this->time1,0,5);
        $input_end_date = $this->date2.substr($time2,0,5);

        $input_start_date = Carbon::createFromFormat('Y-m-dH:i', $input_start_date);
        $input_start_date = Carbon::parse($input_start_date);

        $input_end_date = Carbon::createFromFormat('Y-m-dH:i', $input_end_date);
        $input_end_date = Carbon::parse($input_end_date);

        return ($input_start_date->isAfter($now) and $input_end_date->isAfter($now) and $input_start_date->isBefore($input_end_date) and $input_end_date->isAfter($input_start_date));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Date must be correct.";
    }
}
