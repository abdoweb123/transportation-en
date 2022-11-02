<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StationController;



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
Route::group(['middleware'=>['guest']], function ()
{
    Route::get('/', function () { return view('auth.login'); });
});





Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function(){

    // ======================  login page ======================
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('/login', 'LoginController@login')->middleware('guest')->name('login');
        Route::get('/logout/{type}', 'LoginController@logout')->name('logout');
    });


    // dashboard of user
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // dashboard of superVisor
    Route::get('/superVisor/dashboard', function (){ return view('superVisor.dashboard'); });

    // dashboard of employee
    Route::get('/employee/dashboard', function (){ return view('employee.dashboard'); });



    // ======================  cities ======================
    Route::resource('cities','CityController');

    // ======================  stations ======================
    Route::resource('stations','StationController');

    // ======================  buses ======================
    Route::resource('buses','BusController');


    // ======================  seats ======================
    Route::resource('seats','SeatController')->except('update','edit');
    Route::post('update/seats',[SeatController::class,'update'])->name('update.seats');


    // ======================  ajax ======================
    Route::get('show_bus_seats/{slug_value}',[SeatController::class,'show_bus']);
    Route::get('show/bus/seats/{id}',[SeatController::class,'showBusSeats'])->name('show.bus.seats');






    // ======================  Admin ======================
    Route::group(['prefix' => 'branches'], function ()
    {
        Route::get('register/admin/view', [AdminController::class, 'registerView'])->name('registerView')->middleware('auth:admin');
        Route::post('register/test', [AdminController::class, 'registerTest'])->name('registerTest');
        Route::get('/admin/dashboard', function (){ return view('admin.dashboard'); });
    });



}); //end of routes
