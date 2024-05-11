<?php

declare(strict_types=1);

use App\Modules\Reservation\ReservationController;
use Illuminate\Support\Facades\Route;

Route::post('/reservations', [ReservationController::class, 'post']);
