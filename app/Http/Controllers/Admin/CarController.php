<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\User;

class CarController extends Controller
{
    public function index(){

       $cars = DB::table('cars')->get();

       return view('dashboard.admin.car.all',[ 'cars' => $cars]);
    }

    public function show(){

        if(request('no_plate')){

            //dd(request('no_plate'));
            $no_plate = request('no_plate');

            $car = DB::table('cars')->where('no_plate', $no_plate)->first();

            $books = DB::table('booking')->where('no_plate', $no_plate)->get();

            return view('dashboard.admin.car.show',[ 'car' => $car, 'books' => $books]);
        }


     }

     public function add(){

        return view('dashboard.admin.car.add');

     }

     public function save(){

        request()->validate([
            'no_plate'=>'required',
            'car_name'=>'required',
            'rate'=>'required|numeric',
        ]);

        $image = request('uri');

        if(strlen($image) > 128) {
            list($mime, $data)   = explode(';', $image);
            list(, $data)       = explode(',', $data);
            $data = base64_decode($data);

            $mime = explode(':',$mime)[1];
            $ext = explode('/',$mime)[1];
            $name_path = mt_rand().time();
            $savePath = 'images/'.$name_path.'.'.$ext;

            file_put_contents(public_path().'/'.$savePath, $data);

            //saving file to Car model
            $car = new Car();
            $car->car_name = request('car_name');
            $car->no_plate = request('no_plate');
            $car->rate = request('rate');
            $car->link = $savePath;
            $car->save();
        }

        return redirect()->route('admin.car.all');

     }

     public function change_underservice(){

        $car = Car::where('no_plate',request('no_plate'))->first();

        $car->toggleUnderService()->save();

        return back()->with('status', 'Image Has been uploaded');
     }
}
