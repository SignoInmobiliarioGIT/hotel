<?php

use Illuminate\Support\Facades\DB;
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
    Route::get('/', 'SchedulerController@index')->name('dashboard');
    Route::get('reservations', 'ReservationController@index');
    Route::resource('scheduler', 'SchedulerController');
});

// Route::get('/scheduler', function () {
//     return view('scheduler/scheduler');
// });
