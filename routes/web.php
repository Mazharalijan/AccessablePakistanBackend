<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\LocationtypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard.index');
Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');

    });
    Route::group(['middleware' => 'admin.auth'], function () {
        //
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [DashboardController::class, 'logout'])->name('admin.logout');
        Route::get('/change-password', [AdminLoginController::class, 'changePassword'])->name('admin.change-password');

        // Address Routes

        Route::get('/address', [AddressController::class, 'index'])->name('admin.addresslist');
        Route::get('/address/{status}', [AddressController::class, 'statusIndex'])->name('admin.addressstatus');
        Route::delete('/address/{address}', [AddressController::class, 'destroy'])->name('address.delete');
        Route::get('/address/{address}/edit', [AddressController::class, 'edit'])->name('address.edit');
        Route::get('/counts', [AddressController::class, 'totalAddressCount'])->name('counts');
        Route::put('/address/{address}', [AddressController::class, 'update'])->name('address.update');

        // District Routes
        Route::get('/district', [DistrictController::class, 'districtList'])->name('admin.districtlist');
        Route::get('/district/create', [DistrictController::class, 'create'])->name('district.create');
        Route::get('/district/{district}/edit', [DistrictController::class, 'edit'])->name('district.edit');
        Route::put('/district/{district}', [DistrictController::class, 'update'])->name('district.update');
        Route::post('/district', [DistrictController::class, 'store'])->name('district.store');
        Route::delete('/district/{district}', [DistrictController::class, 'destroy'])->name('district.delete');

        //Location type Routes
        Route::get('/location-type', [LocationtypeController::class, 'locationList'])->name('admin.location-type');
        Route::get('/location-type/create', [LocationtypeController::class, 'create'])->name('location-type.create');

        Route::get('/location-type/{locationtype}/edit', [LocationtypeController::class, 'edit'])->name('location-type.edit');
        Route::put('/location-type/{locationtype}', [LocationtypeController::class, 'update'])->name('location-type.update');
        Route::post('/location-type', [LocationtypeController::class, 'store'])->name('location-type.store');
        Route::delete('/location-type/{locationtype}', [LocationtypeController::class, 'destroy'])->name('locationtype.destroy');

    });

});
