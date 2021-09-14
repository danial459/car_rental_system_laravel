<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;

class ChangeBookActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change_book_active:every_15_minutes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'When user recently used the car, the data in active column in booking table is changed to 0(end of book)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();

        $users = User::with('cars')->get();

        foreach($users as $user){

            foreach($user->cars as $car){

                $end_date = $car->pivot->end_date.$car->pivot->end_time;

                $end_date = Carbon::createFromFormat('Y-m-dH:i:s',$end_date);
                $end_date = Carbon::parse($end_date);

              if($now->isAfter($end_date)){

                 $car->changeBookActive();

              }
            }

        }

        $this->info('Successful');
        //return 0;
    }
}
