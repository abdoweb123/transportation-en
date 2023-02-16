<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\StationController;
use App\Http\Controllers\Api\PublicServiceController;
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

// employee auth
Route::post('login-employee', [EmployeeController::class,'login']);
// emplyee api
Route::group(['middleware'=>'auth:employee-api'], function () {
    Route::post('change_password', [UserController::class,'change_password']);
    Route::get('profile', [UserController::class,'show']);
    Route::post('update', [EmployeeController::class,'update']);
    // booking request
    Route::get('booking-request', [EmployeeController::class,'booking_request']);
    Route::post('swap-request', [EmployeeController::class,'swap_request']);
    Route::post('add-review', [EmployeeController::class,'add_review']);

}); //end of routes
// employeeee
Route::get('booking-request/{id}', [EmployeeController::class,'booking_request_details']);



// driver auth
Route::post('driver-login', [DriverController::class,'login']);
Route::group(['middleware'=>'auth:driver-api'], function () {

    Route::get('trips', [DriverController::class,'employeeRunTripsBuses']);
    Route::post('location-tracker', [DriverController::class,'location_tracker']);
    Route::post('station-tracker', [DriverController::class,'station_tracker']);
}); //end of routes
Route::get('trips/{employee_run_trip_bus_id}', [DriverController::class,'employeeRunTripsBusesDetails']);

// driver app
Route::get('started-trip/{id}', [DriverController::class,'started_trip']);
Route::get('end-trip/{id}', [DriverController::class,'end_trip']);
Route::post('client-tracker', [DriverController::class,'client_tracker']);
Route::get('get-review/{id}', [DriverController::class,'get_review']);



// user auth
Route::post('login', [UserController::class,'login']);
Route::post('forget-pass-user', [UserController::class,'reset_pass']);
Route::post('verification', [UserController::class,'verification']);
Route::post('register', [UserController::class,'register']);
Route::post('register-user-social', [UserController::class,'register_social']);
Route::post('new-password', [UserController::class,'new_password']);
// company auth
Route::post('login-company', [CompanyController::class,'login']);
Route::post('register-company', [CompanyController::class,'register']);

Route::group(['middleware'=>'auth:api'], function () {
    Route::post('change_password', [UserController::class,'change_password']);
    Route::get('profile', [UserController::class,'show']);
    Route::post('add-favorite', [UserController::class,'add_favorite']);
    Route::get('get-favorite', [UserController::class,'get_favorite']);
    Route::post('add-offer', [OfferController::class,'add_offer']);
    Route::post('update/{id}', [UserController::class,'update']);

}); //end of routes


// admin auth
Route::post('admin-login', [AdminController::class,'login']);
Route::group(['middleware'=>'auth:admin-api'], function () {
    // station
    Route::get('get-stations', [StationController::class,'get_stations']);
    Route::post('add-station', [StationController::class,'add_stations']);
}); 

// public service
Route::get('cities', [PublicServiceController::class,'cities']);
