<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Car;
use App\Rules\OverlapBookCheck;
use App\Rules\ValidateBookDate;
use \DateTime;
use Carbon\Carbon;
use App\CalcPrice;
use Auth;

class BookingController extends Controller
{
    public function create(){

        $cars = Car::where('under_service', false)->get();

        return view('dashboard.booking.create.detail',['cars' => $cars ]);
    }

    public function confirmation(Request $request){


        $request->validate([
            'start_date' => ['required'],
            'start_time' => ['required'],
            'end_date' => ['required'],
            'end_time'=> ['required',new OverlapBookCheck(request('start_date'),request('start_time'),request('end_date'),request('no_plate')),
                                     new ValidateBookDate(request('start_date'),request('start_time'),request('end_date'))],
            'no_plate' => ['required'],
            'pick_up' => ['required'],
             ],[

            'no_plate.required' => 'Please choose a car',
            'pick_up.required' => 'Please choose a place to pick up a car'

             ]);



        //dd($request->all());

        session(['start_date' => request('start_date')]);
        session(['end_date' => request('end_date')]);
        session(['start_time' => request('start_time')]);
        session(['end_time' => request('end_time')]);
        session(['pick_up' => request('pick_up')]);
        session(['note' => request('note')]);
        session(['no_plate' => request('no_plate')]);

        //dd(session()->all());


        $price = new CalcPrice( session('start_date'),session('start_time'),session('end_date'),session('end_time'),request('no_plate'),request('action'));

        $totalPrice = $price->Prices();

        session(['price' => $totalPrice]);

        if(request('action') == 1){


            return view('dashboard.booking.create.confirmation',[ 'car' => Car::find(request('no_plate'))]);
         }

         else{

             return view('dashboard.booking.update.confirmation',[ 'car' => Car::find(request('no_plate'))]);
         }




    }

    public function store(Request $request){

        $storeBook = new Car();

        $storeBook->no_plate = session('no_plate');

        $storeBook->users()->attach(auth()->user()->name,['start_date' => session('start_date'),
                                                          'end_date' => session('end_date'),
                                                          'start_time' => session('start_time'),
                                                          'end_time' => session('end_time'),
                                                          'pick_up' => session('pick_up'),
                                                          'note' => session('note'),
                                                          'price' => session('price')]);

         $request->session()->forget(['start_date', 'end_date', 'start_time', 'end_time', 'pick_up', 'note', 'price', 'book_id', 'no_plate']);

        return redirect()->route('user.home')->with('success','You have just booked a car');

    }

    public function show(){

        return view('dashboard.user.booking',['myBooks' => Auth::user()->cars]);
    }


    public function edit(Request $request){

        $request->session()->forget(['start_date', 'end_date', 'start_time', 'end_time', 'pick_up', 'note', 'price', 'book_id', 'no_plate']);

        session(['book_id' => request('id')]);

        $mybooking = Auth::user()->cars()->where('id',request('id'))->first();

        return view('dashboard.booking.update.detail',['myBook' =>  $mybooking,'cars' => Car::all()]);

    }

    public function update(Request $request){

        DB::table('booking')
        ->where('id', session('book_id'))
        ->update([
          'start_date' => session('start_date'),
          'end_date' => session('end_date'),
          'start_time' => session('start_time'),
          'end_time' => session('end_time'),
          'pick_up' => session('pick_up'),
          'note' => session('note'),
          'price' => session('price'),
          'no_plate' => session('no_plate'),

        ]);

        $request->session()->forget(['start_date', 'end_date', 'start_time', 'end_time', 'pick_up', 'note', 'price', 'book_id', 'no_plate']);

        return redirect()->route('user.myBooking');
    }

    public function destroy(Request $request){

        //dd($request->all());

        $book_id_delete = request('book_delete');

         DB::table('booking')->where('id',$book_id_delete)->delete();

        return redirect(route("user.myBooking"));
    }
}
