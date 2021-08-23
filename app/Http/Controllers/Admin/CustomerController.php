<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CalcPrice;
use App\Models\Car;
use App\Models\User;

class CustomerController extends Controller
{
    public function index(){

        $customers = User::all();

        return view('dashboard.admin.customer.all',[ 'customers' => $customers]);

    }

    public function show(){

        $custName = request('custName');

        $customer = DB::table('users')->where('name', $custName)->first();

        $books = DB::table('booking')->where('name', $custName)->get();

        //dd($books);

        return view('dashboard.admin.customer.show',[ 'cust' => $customer, 'books' => $books]);

    }

}
