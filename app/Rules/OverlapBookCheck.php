<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OverlapBookCheck implements Rule
{
    protected $date1,$time1,$date2,$no_plate;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date1,$time1,$date2,$no_plate)
    {
        $this->date1 = $date1;
        $this->time1 = $time1;
        $this->date2 = $date2;
        $this->no_plate = $no_plate;
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
        $cek = true;
        $time2 = $value;

        if ( !$this->date1 or !$this->time1 or !$this->date2 ) {
            return back();
        }

        $id1 = $this->date1.$this->time1;
        $id2 = $this->date2.$time2;

        $id1 = Carbon::createFromFormat('Y-m-dH:i', $id1);
        $id1 = Carbon::parse($id1);

        $id2 = Carbon::createFromFormat('Y-m-dH:i', $id2);
        $id2 = Carbon::parse($id2);

        $cars = DB::table('booking')
                ->where('no_plate', '=', $this->no_plate)
                ->get();

        foreach($cars as $car){

          $date1 = $car->start_date.$car->start_time;
          $date2 = $car->end_date.$car->end_time;

          $date1 = Carbon::createFromFormat('Y-m-dH:i:s', $date1);
          $od1 = Carbon::parse($date1);

          $date2 = Carbon::createFromFormat('Y-m-dH:i:s', $date2);
          $od2 = Carbon::parse($date2);

          if( !(($id1->isBefore($od1) && $id2->isBefore($od1) && $id1->isBefore($od2) && $id2->isBefore($od2))  ||
              ($id1->isAfter($od1) && $id2->isAfter($od1) && $id1->isAfter($od2) && $id2->isAfter($od2))) ){

                return false;

             }

        }

        return true;

        // $od1 = Carbon::create(2021, 9, 9, 14, 15);
        // $od2 = Carbon::create(2021, 9, 12, 20, 15);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The date is overlaps with other user.';
    }
}
