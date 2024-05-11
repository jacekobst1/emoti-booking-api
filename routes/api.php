<?php

declare(strict_types=1);

use App\Modules\Reservation\ReservationController;
use Illuminate\Support\Facades\Route;

Route::prefix('/reservations')->group(function () {
    Route::get('/', [ReservationController::class, 'getReservationsList']);
    Route::post('/', [ReservationController::class, 'postReservation']);
});
