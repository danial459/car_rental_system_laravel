<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.user.home',[ 'books' => Auth::user()->cars()->where('active',1)->take(5)->get()  ]);
    }

    public function showAllCars()
    {
        $Cars = Car::where('under_service',0)->get();

        return view('dashboard.user.cars',[ 'cars' => $Cars]);
    }
}
