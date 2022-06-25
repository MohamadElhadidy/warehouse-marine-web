<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\PermitController;
use App\Models\Permit;
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
Route::get('/login', function () {return view('login');})->name('/');

Route::get('/', function () {
    return view('home');
});
Route::resource('warehouse', WarehouseController::class);
Route::resource('type', TypeController::class);
Route::resource('client', ClientController::class);
Route::resource('goods', GoodsController::class);
Route::resource('permit', PermitController::class);
Route::get('/permit/cost/{id}', [PermitController::class, 'cost'])->name('/permit/cost/');
Route::get('/permit/print/{id}', [PermitController::class, 'print'])->name('/permit/print/');
Route::post('/permit/cost', [PermitController::class, 'addCost'])->name('/permit/cost/');



