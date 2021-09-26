<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OverlapBookCheck implements Rule
{
    protected $date1,$time1,$date2,$no_plate,$booking_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date1,$time1,$date2,$no_plate,$booking_id)
    {
        $this->date1 = $date1;
        $this->time1 = $time1;
        $this->date2 = $date2;
        $this->no_plate = $no_plate;
        $this->booking_id = $booking_id;
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

        if ( !$this->date1 or !$this->time1 or !$this->date2 ) {
            return back();
        }

        $input_start_date = $this->date1.substr($this->time1,0,5);
        $input_end_date = $this->date2.substr($time2,0,5);

        $input_start_date = Carbon::createFromFormat('Y-m-dH:i', $input_start_date);
        $input_start_date = Carbon::parse($input_start_date);

        $input_end_date = Carbon::createFromFormat('Y-m-dH:i', $input_end_date);
        $input_end_date = Carbon::parse($input_end_date);

        if($this->booking_id){

            $cars = DB::table('booking')
                    ->where('no_plate', '=', $this->no_plate)
                    ->whereNotIn('id', [$this->booking_id])
                    ->where('active', 1)
                    ->get();

        }
        else{

            $cars = DB::table('booking')
                    ->where('no_plate', '=', $this->no_plate)
                    ->where('active', 1)
                    ->get();

        }

        foreach($cars as $car){

          $date1 = $car->start_date.$car->start_time;
          $date2 = $car->end_date.$car->end_time;

          $date1 = Carbon::createFromFormat('Y-m-dH:i:s', $date1);
          $booking_start_date = Carbon::parse($date1);

          $date2 = Carbon::createFromFormat('Y-m-dH:i:s', $date2);
          $booking_end_date = Carbon::parse($date2);

          if( !(($input_start_date->isBefore($booking_start_date) && $input_end_date->isBefore($booking_start_date) && $input_start_date->isBefore($booking_end_date) && $input_end_date->isBefore($booking_end_date))  ||
              ($input_start_date->isAfter($booking_start_date) && $input_end_date->isAfter($booking_start_date) && $input_start_date->isAfter($booking_end_date) && $input_end_date->isAfter($booking_end_date))) ){

                return false;
             }
        }

        return true;

        // $booking_start_date = Carbon::create(2021, 9, 9, 14, 15);
        // $booking_end_date = Carbon::create(2021, 9, 12, 20, 15);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The date is overlaps with other booking.';
    }
}
