<?php

use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\FieldController;
use Illuminate\Support\Facades\Route;

//Public
Route::post('/reservations', [ReservationController::class, 'store']);
Route::get('/reservations', [ReservationController::class, 'index']);
Route::get('/fields', [FieldController::class, 'index']);

//Admin
Route::group(['middleware' => ['auth:sanctum']], function () {
Route::get('/admin/reservations', [ReservationController::class, 'adminIndex']);
Route::post('/admin/fields', [FieldController::class, 'update']);
});
