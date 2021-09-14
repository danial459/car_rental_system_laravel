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


        $id1 = $this->date1.substr($this->time1,0,5);
        $id2 = $this->date2.substr($time2,0,5);

        $id1 = Carbon::createFromFormat('Y-m-dH:i', $id1);
        $id1 = Carbon::parse($id1);

        $id2 = Carbon::createFromFormat('Y-m-dH:i', $id2);
        $id2 = Carbon::parse($id2);

        return ($id1->isAfter($now) and $id2->isAfter($now) and $id1->isBefore($id2) and $id2->isAfter($id1));

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
