<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('user/bookings',[BookingController::class, 'index'])->name('bookings.index');
Route::get('create/booking',[BookingController::class, 'create'])->name('bookings.create');
Route::post('create/user/booking',[BookingController::class, 'store'])->name('stroreBooking');
Route::get('edit/user/booking/{id}', [BookingController::class, 'edit'])->name('booking.edit');
Route::post('update/user/booking/{id}', [BookingController::class, 'update'])->name('booking.update');
Route::get('show/user/booking/{id}', [BookingController::class, 'show']);
Route::post('destroy/user/booking/{id}', [BookingController::class, 'destroy'])->name('booking.delete');
