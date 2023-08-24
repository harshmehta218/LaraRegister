<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('user/bookings',[BookingController::class, 'index']);
// Route::post('create/user/booking',[BookingController::class, 'store']);
// Route::put('update/user/booking/{id}', [BookingController::class, 'update']);
// Route::get('show/user/booking/{id}', [BookingController::class, 'show']);
// Route::delete('destroy/user/booking/{id}', [BookingController::class, 'destroy']);
