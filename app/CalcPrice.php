<?php

namespace App;
use App\Models\Car;
use \DateTime;
use Carbon\Carbon;

 class CalcPrice
{
      public $sd,$st,$ed,$et,$no_plate,$action;

     function __construct($sd,$st,$ed,$et,$no_plate,$action)
    {

        $this->sd = $sd;
        $this->st = $st;
        $this->ed = $ed;
        $this->et = $et;
        $this->no_plate = $no_plate;
        $this->action = $action;
    }


     function Prices(){

        $sd1 = $this->sd.$this->st;
        $ed1 = $this->ed.$this->et;

        //update booking
        if($this->action == '2'){

            $sd2 = DateTime::createFromFormat('Y-m-dH:i:s', $sd1)->format('Y-m-d H:i:s');
            $ed2 = DateTime::createFromFormat('Y-m-dH:i:s', $ed1)->format('Y-m-d H:i:s');
        }

        //new booking
        else if ($this->action == '1'){

            $sd2 = DateTime::createFromFormat('Y-m-dH:i', $sd1)->format('Y-m-d H:i:s');
            $ed2 = DateTime::createFromFormat('Y-m-dH:i', $ed1)->format('Y-m-d H:i:s');
        }

        $sd3 = Carbon::parse($sd2);
        $ed3 = Carbon::parse($ed2);

        $totalmin = $ed3->diffInMinutes($sd3);

        $car = Car::where('no_plate',$this->no_plate)->firstOrFail();

        $total = ($totalmin/60)*$car->rate;

        return $total;
   }
  }
