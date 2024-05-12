<?php

declare(strict_types=1);

use App\Http\Controllers\UserController;
use App\Modules\Reservation\ReservationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logged-user', [UserController::class, 'getLoggedUser']);

    Route::prefix('/reservations')->group(function () {
        Route::get('/', [ReservationController::class, 'getReservationsList']);
        Route::post('/', [ReservationController::class, 'postReservation']);
    });
});

Route::prefix('/unguarded')->group(function () {
    Route::prefix('/reservations')->group(function () {
        Route::get('/', [ReservationController::class, 'getReservationsList']);
        Route::post('/', [ReservationController::class, 'postReservation']);
    });
});
