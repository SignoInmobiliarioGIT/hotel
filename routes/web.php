<?php

use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('login');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');



Route::middleware(['auth'])->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    /**
     * Scheduler
     */
    Route::get('scheduler/get-companions', 'SchedulerController@getCompanions');
    Route::resource('scheduler', 'SchedulerController');

    /**
     * Reservations
     */
    Route::get('reservation/check-in', 'ReservationController@getCheckIn');
    Route::get('reservation/check-out', 'ReservationController@getCheckOut');
    Route::resource('reservation-companion', 'ReservationCompanionController');
    Route::resource('reservation', 'ReservationController');

    /**
     * Rooms
     */
    Route::get('room/available-in-range', 'RoomController@availableInRange');
    Route::get('room/cleaning-status', 'RoomController@cleaningStatuses');
    Route::resource('room', 'RoomController');
});



Route::get('/scheduler-test', function () {
    return view('scheduler/scheduler');
});
