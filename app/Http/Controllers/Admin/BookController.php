<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CalcPrice;
use App\Models\Car;
use App\Models\User;

class BookController extends Controller
{
    public function show(){

        $books = DB::table('booking')->find(request('id'));

        return view('dashboard.admin.book.show',['books' => $books]);

    }

    public function destroy(){

        $book_id_delete = request('admin_delete_book_id');

        DB::table('booking')->where('id',$book_id_delete)->delete();

        return redirect(route("admin.home"));

    }

    public function editBook(){

        session(['bookId' => request('bookId')]);

        $book = DB::table('booking')->where('id', session('bookId'))->first();

        $cars = DB::table('cars')->get();

        return view('dashboard.admin.book.edit',['book' => $book, 'cars' => $cars]);


    }

    public function confirmBook(){

        session(['start_date' => request('start_date')]);
        session(['end_date' => request('end_date')]);
        session(['start_time' => request('start_time')]);
        session(['end_time' => request('end_time')]);
        session(['pick_up' => request('pick_up')]);
        session(['note' => request('note')]);
        session(['no_plate' => request('no_plate')]);

        $price = new CalcPrice( session('start_date'),session('start_time'),session('end_date'),session('end_time'),session('no_plate'),request('action'));

        $totalPrice = $price->Prices();

        session(['price' => $totalPrice]);

        return view('dashboard.admin.book.confirmation',[ 'car' => Car::find(session('no_plate'))]);

    }

    public function updateBook(Request $request){

        DB::table('booking')
        ->where('id', session('bookId'))
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

        $request->session()->forget(['start_date', 'end_date', 'start_time', 'end_time', 'pick_up', 'note', 'price', 'bookId', 'no_plate']);

        return redirect()->route('admin.home');

    }
}
