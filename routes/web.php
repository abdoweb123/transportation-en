<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
//use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\BookingRequestController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BusTypeController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EmployeeRunTripController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ReminderHistoryController;
use App\Http\Controllers\RouteStationController;
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
use App\Http\Controllers\CustomerTypeController;
use App\Http\Controllers\MillageController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\EfficiencyFuelController;
use App\Http\Controllers\ManuallyFuelController;
use App\Http\Controllers\EmployeeJobController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MyEmployeeController;
use App\Http\Controllers\RouteController;
use App\Http\Livewire\StaticTables\StaticTables;
use App\Http\Livewire\ContractClients\ContractClientsEdit;
use App\Http\Livewire\ContractClients\ContractClients;
use App\Http\Livewire\ContractSubliers\ContractSubliersEdit;
use App\Http\Livewire\ContractSubliers\ContractSubliers;
use App\Http\Livewire\CompanyContractRoutes\CompanyContractRoutes;
use App\Http\Livewire\CompanyContractRoutes\CompanyContractRoutesEdit;
use App\Http\Livewire\SuplierContractRoutes\SuplierContractRoutes;
use App\Http\Livewire\SuplierContractRoutes\SuplierContractRoutesEdit;
use App\Http\Livewire\Penelties\Penelties;
// use App\Http\Livewire\Penelties\PeneltiesEdit;
use App\Http\Livewire\Accidents\Accidents;
use App\Http\Livewire\CarPayments\CarPayments;
use App\Http\Livewire\CarPaymentDates\CarPaymentDates;
use App\Http\Livewire\DriverSalaries\DriverSalaries;
use App\Http\Livewire\Gases\Gases;
use App\Http\Livewire\ExtraFees\ExtraFees;
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
    Route::group([/*'middleware'=>'auth:admin'*/], function () {
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

    Route::resource('cities',CityController::class);
    Route::resource('stations',StationController::class)->except('create','edit','show');
    Route::resource('offices',OfficeController::class);
    Route::resource('busTypes',BusTypeController::class)->except('create','edit','show');
    Route::get('show/busType/seats/{id}',[BusTypeController::class,'showBusTypeSeats'])->name('show.busType.seats');

    Route::resource('buses',BusController::class);
    Route::get('show/bus/seats/{id}',[BusController::class,'showBusSeats'])->name('show.bus.seats');

    Route::resource('seats',SeatController::class)->except('update','edit');
    Route::post('update/seats',[SeatController::class,'update'])->name('update.seats');

    Route::resource('tripData','TripDataController')->except('create','edit','show');

    // stations of trip
    Route::get('stations/of/trip/{id}',[TripStationController::class,'getStationsOfTrip'])->name('getStationsOfTrip');
    Route::resource('tripStations',TripStationController::class)->only('store','update','destroy');

    // Lines of trip
    Route::post('create/lines/of/trip',[LineController::class,'createLinesOfTrip'])->name('createLinesOfTrip');
    Route::get('get/undegreeded/lines/of/trip/{tripData_id}',[LineController::class,'getUndegreededLinesOfTrip'])->name('getUndegreededLines');
    Route::post('add/degrees/to/lines',[LineController::class,'addDegreesToLines'])->name('add.degrees.to.lines');
    Route::get('get/all/lines/of/trip/{tripData_id}',[LineController::class,'getAllLinesOfTrip'])->name('getAllLinesOfTrip');
    Route::post('update/lines',[LineController::class,'updateLines'])->name('updateLines');


    Route::resource('degrees',DegreeController::class)->except('create','edit','show');

    Route::resource('runTrips',RunTripController::class)->except('create','edit','show');


    // Seats design of Trip
    Route::get('show/busType/seats/of/trip/{id}',[TripSeatController::class,'showBusTypeSeatsOfTrip'])->name('showBusTypeSeatsOfTrip');
    Route::post('create/trip/seats',[TripSeatController::class,'createTripSeats'])->name('createTripSeats');
    Route::put('update/trip/seats',[TripSeatController::class,'updateTripSeats'])->name('updateTripSeats');


    Route::resource('coupons',CouponController::class)->except('show');
    Route::resource('couponTrips',CouponTripController::class)->except('create','edit','show');
    Route::resource('packages',PackageController::class)->except('create','edit','show');
    Route::resource('bookedPackages',BookedPackageController::class)->except('create','show');
    Route::resource('customerTypes',CustomerTypeController::class)->except('create','show','edit');
    Route::resource('millages',MillageController::class)->except('create','show','edit');
    Route::resource('vendors',VendorController::class)->except('create','show','edit');
    Route::resource('categories',CategoryController::class)->except('create','show','edit');
    Route::resource('issues',IssueController::class)->except('create','show','edit');
    Route::resource('efficiencyFuels',EfficiencyFuelController::class)->except('create','show','edit');
    Route::resource('manuallyFuels',ManuallyFuelController::class)->except('create','show','edit');
    Route::resource('employeeJobs',EmployeeJobController::class)->except('create','show','edit');
    Route::resource('departments',DepartmentController::class)->except('create','show','edit');
    Route::resource('myEmployees',MyEmployeeController::class)->except('show');
    Route::resource('routes',RouteController::class)->except('edit','show','create');
    Route::resource('routeStations',RouteStationController::class)->except('edit','show','create');
    Route::resource('employeeRunTrips',EmployeeRunTripController::class)->except('edit','show','create','store');
    Route::resource('reminders',ReminderController::class)->except('show');
    Route::resource('reminderHistory',ReminderHistoryController::class)->only('index','destroy');
    Route::get('getReminder/{id}',[ReminderHistoryController::class,'getReminder'])->name('getReminder');



    // استيراد بيانات الموظفين
//    Route::get('get/excel',[MyEmployeeController::class,'getExcel'])->name('getExcel.excelEmployee');

    Route::get('operation1/{routeStation_station_cp}/{excelEmployeesDatum}/{station_site}/{routeStation}',[RouteStationController::class,'operation1'])->name('operation1');
    Route::get('add/bus/to/booking/request',[RouteStationController::class,'operation2'])->name('add_bus.to.booking_request');

    Route::resource('bookingRequests',BookingRequestController::class)->except('edit','show','create');
    Route::get('get/add/booking',[BookingRequestController::class,'getAddBooking'])->name('getAddBooking');
    Route::get('search/employeeRunTrip',[BookingRequestController::class,'searchEmployeeRunTrip'])->name('searchEmployeeRunTrip');
    Route::post('create/new/booking',[BookingRequestController::class,'createNewBooking'])->name('createNewBooking');
    Route::post('import/excel',[MyEmployeeController::class,'import'])->name('import.excelEmployee');
    Route::get('store/employees/data',[RouteStationController::class,'operation'])->name('store.employees.data');
    Route::get('bookingRequests/data',[BookingRequestController::class,'bookingRequestsData'])->name('bookingRequestsData');
    Route::get('employeeRunTrip',[BookingRequestController::class,'employeeRunTrip'])->name('employeeRunTrip');
    Route::get('getAssignEmployee',[BookingRequestController::class,'getAssignEmployee'])->name('getAssignEmployee');
    Route::get('swap/bus/{booking_id?}/{employee_id?}',[BookingRequestController::class,'swapBus'])->name('swapBus');
    Route::get('getRouteStations/{id}',[BookingRequestController::class,'getRouteStations']); //by ajax
    Route::post('swapBusFinal',[BookingRequestController::class,'swapBusFinal'])->name('swapBusFinal');


    // trans port
    // company name
    Route::get('static-table/{type}',StaticTables::class)->name('static-table');
    // contract client
    Route::get('contract-client',ContractClients::class)->name('contract-client');
    Route::get('contract-client-edit/{id}',ContractClientsEdit::class)->name('contract-client');
      // contract subliers
    Route::get('contract-sublier',ContractSubliers::class)->name('contract-sublier');
    Route::get('contract-sublier-edit/{id}',ContractSubliersEdit::class)->name('contract-sublier');
    Route::get('company-contract-route',CompanyContractRoutes::class)->name('company-contract-route');
    Route::get('company-contract-route-edit/{id}',CompanyContractRoutesEdit::class)->name('company-contract-route-edit');
    Route::get('suplier-contract-route',SuplierContractRoutes::class)->name('suplier-contract-route');
    Route::get('suplier-contract-route-edit/{id}',SuplierContractRoutesEdit::class)->name('suplier-contract-route-edit');

    //   Penelty
    Route::get('penelties',Penelties::class)->name('penelties');
    // Route::get('penelties-edit/{id}',PeneltiesEdit::class)->name('enelties-edit');
    // acciednt
    Route::get('accidents',Accidents::class)->name('accidents');
    // car_payments_table
    Route::get('car-payments',CarPayments::class)->name('car-payment');
    Route::get('car-payment-dates/{car_payment_id}',CarPaymentDates::class)->name('car-payment-dates');
    // driver sallary
    Route::get('driver-salary',DriverSalaries::class)->name('driver-salary');

    Route::get('gases',Gases::class)->name('gases');
    Route::get('extra-fees',ExtraFees::class)->name('extra-fees');


    // Reports
    Route::get('empty/seats/per/bus',[BusController::class,'emptySeatsPerBus'])->name('emptySeatsPerBus');

    Route::get('employees/names/per/bus',[BusController::class,'getRunTripByBus_id'])->name('getRunTripByBus_id');

//    Route::get('employees/names/per/bus',[BusController::class,'employeesNamesPerBus'])->name('employeesNamesPerBus');

    Route::get('empty/seats/per/Route',[BusController::class,'emptySeatsPerRoute'])->name('emptySeatsPerRoute');



}); //end of routes
