<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class OverlapBookCheck implements Rule
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

        $id1 = $this->date1.$this->time1;
        $id2 = $this->date2.$time2;

        $id1 = Carbon::createFromFormat('Y-m-dH:i', $id1);
        $id1 = Carbon::parse($id1);

        $id2 = Carbon::createFromFormat('Y-m-dH:i', $id2);
        $id2 = Carbon::parse($id2);

        $od1 = Carbon::create(2021, 8, 25, 14, 15);
        $od2 = Carbon::create(2021, 8, 27, 20, 15);

        return   ($id1->isBefore($od1) and $id2->isBefore($od1) and $id1->isBefore($od2) and $id2->isBefore($od2))  or
               ($id1->isAfter($od1) and $id2->isAfter($od1) and $id1->isAfter($od2) and $id2->isAfter($od2));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The date is overlap with other user.';
    }
}
