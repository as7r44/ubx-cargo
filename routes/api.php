<?php

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

Route::resource('/cargos' , App\Http\Controllers\CargoController::class);


Route::fallback(function () {
    return response()->json([
        'message' => 'Failed',
        'data' => 'Route Not Found',
    ],404
    );
    // return view('errors.404');  // incase you want to return view
});

// Route::get('/cargos' , [App\Http\Controllers\CargoController::class, 'index']);
// Route::get('/cargo/{id}' , [App\Http\Controllers\CargoController::class, 'show']);
