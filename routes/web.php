<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
//use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BusTypeController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\TripDataController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\TripStationController;
use App\Http\Controllers\RunTripController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\TripSeatController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CouponTripController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BookedPackageController;



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
    Route::get('/', [LoginController::class,'showLoginForm']);
});





Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function(){


    // ====================== admin login ======================
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('/login', [LoginController::class,'login'])->middleware('guest')->name('login.admin');
        Route::get('/logout', [LoginController::class,'logout'])->middleware('auth:admin')->name('logout');
    });


    // ====================== admin ( employee ) ======================
    Route::group(['middleware'=>'auth:admin'], function () {
        Route::get('get/all/employees/{id}',[AdminController::class,'getAllAdmins'])->name('getAllEmployees');
        Route::post('create/employee',[AdminController::class,'create'])->name('create.employee');
        Route::put('update/employee',[AdminController::class,'update'])->name('update.employee');
        Route::post('delete/employee',[AdminController::class,'delete'])->name('delete.employee');
    });


    // ====================== admin ( manager ) ======================
    Route::group(['middleware'=>'auth:admin'], function () {
        Route::get('get/all/managers/{id}',[AdminController::class,'getAllAdmins'])->name('getAllManagers');
        Route::post('create/manager',[AdminController::class,'create'])->name('create.manager');
        Route::put('update/manager',[AdminController::class,'update'])->name('update.manager');
        Route::post('delete/manager',[AdminController::class,'delete'])->name('delete.manager');
    });


    // ====================== driver ======================
    Route::group(['middleware'=>'auth:admin'], function () {
        Route::get('get/all/drivers',[DriverController::class,'getAllDrivers'])->name('getAllDrivers');
        Route::post('create/driver',[DriverController::class,'create'])->name('create.driver');
        Route::put('update/driver',[DriverController::class,'update'])->name('update.driver');
        Route::post('delete/driver',[DriverController::class,'delete'])->name('delete.driver');
    });


// ====================== user (client) ======================
    Route::group(['middleware'=>'auth:admin'], function () {
        Route::get('get/all/users',[UserController::class,'getAllUsers'])->name('getAllUsers');
        Route::post('create/user',[UserController::class,'create'])->name('create.user');
        Route::put('update/user',[UserController::class,'update'])->name('update.user');
        Route::post('delete/user',[UserController::class,'delete'])->name('delete.user');
    });





    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('cities','CityController');

    Route::resource('stations','StationController')->except('create','edit','show');

    Route::resource('offices','OfficeController');

    Route::resource('busTypes','BusTypeController')->except('create','edit','show');
    Route::get('show/busType/seats/{id}',[BusTypeController::class,'showBusTypeSeats'])->name('show.busType.seats');

    Route::resource('buses','BusController');
    Route::get('show/bus/seats/{id}',[BusController::class,'showBusSeats'])->name('show.bus.seats');

    Route::resource('seats','SeatController')->except('update','edit');
    Route::post('update/seats',[SeatController::class,'update'])->name('update.seats');

    Route::resource('tripData','TripDataController')->except('create','edit','show');

    // stations of trip
    Route::get('stations/of/trip/{id}',[TripStationController::class,'getStationsOfTrip'])->name('getStationsOfTrip');
    Route::resource('tripStations','TripStationController')->only('store','update','destroy');

    // Lines of trip
    Route::post('create/lines/of/trip',[LineController::class,'createLinesOfTrip'])->name('createLinesOfTrip');
    Route::get('get/undegreeded/lines/of/trip/{tripData_id}',[LineController::class,'getUndegreededLinesOfTrip'])->name('getUndegreededLines');
    Route::post('add/degrees/to/lines',[LineController::class,'addDegreesToLines'])->name('add.degrees.to.lines');
    Route::get('get/all/lines/of/trip/{tripData_id}',[LineController::class,'getAllLinesOfTrip'])->name('getAllLinesOfTrip');
    Route::post('update/lines',[LineController::class,'updateLines'])->name('updateLines');


    Route::resource('degrees','DegreeController')->except('create','edit','show');

    Route::resource('runTrips','RunTripController')->except('create','edit','show');


    // Seats design of Trip
    Route::get('show/busType/seats/of/trip/{id}',[TripSeatController::class,'showBusTypeSeatsOfTrip'])->name('showBusTypeSeatsOfTrip');
    Route::post('create/trip/seats',[TripSeatController::class,'createTripSeats'])->name('createTripSeats');
    Route::put('update/trip/seats',[TripSeatController::class,'updateTripSeats'])->name('updateTripSeats');


    Route::resource('coupons','CouponController')->except('create','edit','show');
    Route::resource('couponTrips','CouponTripController')->except('create','edit','show');
    Route::resource('packages','PackageController')->except('create','edit','show');
    Route::resource('bookedPackages','BookedPackageController')->except('create','edit','show');


}); //end of routes
