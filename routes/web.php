<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\User;
use App\Models\Admin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {return view('dashboard.user.login');})->middleware(['guest:admin','guest:web','PreventBackHistory']);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['PreventBackHistory']);


Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest:admin','guest','PreventBackHistory'])->group(function(){

         Route::view('/login','dashboard.user.login')->name('login');

    });

    Route::middleware(['auth','PreventBackHistory'])->group(function(){

         Route::get('/home',[HomeController::class,'index'])->name('home');
         Route::get('/booking',[BookingController::class,'show'])->name('myBooking');
         Route::get('/cars',[HomeController::class,'showAllCars'])->name('cars');

         Route::prefix('booking/create')->name('booking.create.')->group(function(){

              Route::get('/detail',[BookingController::class,'create'])->name('detail');
              Route::get('/confirmation',[BookingController::class,'confirmation'])->name('confirmation');
              Route::post('/store',[BookingController::class,'store'])->name('store');

        });

         Route::prefix('booking/edit')->name('booking.edit.')->group(function(){

              Route::get('/confirmation',[BookingController::class,'confirmation'])->name('confirmation');
              Route::post('/update',[BookingController::class,'update'])->name('update');
              Route::get('/{id}',[BookingController::class,'edit'])->name('detail');

        });

         Route::delete('/booking/delete',[BookingController::class,'destroy'])->name('myBooking.delete');

   });

});

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','guest','PreventBackHistory'])->group(function(){
        Route::view('/login','dashboard.admin.login')->name('login');
        Route::view('/register','dashboard.admin.register')->name('register');
        Route::post('/register',[AdminController::class,'registration'])->name('register.confirm');
        Route::post('/check',[AdminController::class,'check'])->name('check');

    });

    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){

        Route::get('/home',[AdminController::class,'home'])->name('home');
        Route::post('/logout',[AdminController::class,'logout'])->name('logout');

        Route::prefix('book')->name('book.')->group(function(){

             Route::get('/{id}',[BookController::class, 'show'])->name('show');
             Route::delete('/delete',[BookController::class, 'destroy'])->name('delete');

             Route::prefix('edit')->name('edit.')->group(function(){

                  Route::get('/{bookId}/detail',[BookController::class, 'editBook'])->name('detail');
                  Route::get('/{bookId}/confirmation',[BookController::class, 'confirmBook'])->name('confirmation');
                  Route::post('/{bookId}/update',[BookController::class, 'updateBook'])->name('update');

            });

        });

        Route::prefix('customer')->name('customer.')->group(function(){

             Route::get('/all',[CustomerController::class, 'index'])->name('all');
             Route::get('/{custName}',[CustomerController::class, 'show'])->name('show');

        });

        Route::prefix('car')->name('car.')->group(function(){

            Route::get('/all',[CarController::class, 'index'])->name('all');
            Route::get('/plateno/{no_plate}',[CarController::class, 'show'])->name('plateNo.show');
            Route::get('/add',[CarController::class, 'add'])->name('add');
            Route::post('/save',[CarController::class, 'save'])->name('save');
            Route::get('/underservice/',[CarController::class, 'change_underservice'])->name('underService');


       });




    });





});


