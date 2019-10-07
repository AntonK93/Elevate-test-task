<?php

use Illuminate\Http\Request;

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

Route::namespace('Api')->group(function () {
    Route::resource('warehouses', 'WarehousesController', ['except' => ['create', 'edit']]);
    Route::resource('rooms', 'RoomsController', ['except' => ['create', 'edit']]);
    Route::get('warehouses/getRooms/{id}', 'WarehousesController@getRooms');
});
