<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\LocationtypeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/district',[DistrictController::class,'index']);
Route::get('/locationtype',[LocationtypeController::class,'index']);
Route::get('/address',[AddressController::class,'index']);
Route::post('/search',[AddressController::class,'search']);
Route::post('/register',[AddressController::class,'register']);
Route::get('/disabilitytype',[AddressController::class,'disabilitytype']);
