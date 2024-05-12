<?php

declare(strict_types=1);

use App\Http\Controllers\UserController;
use App\Modules\Auth\Enums\RoleEnum;
use App\Modules\Reservation\ReservationController;
use Illuminate\Support\Facades\Route;

$admin = RoleEnum::Admin->value;
$user = RoleEnum::User->value;

// Admin and user routes
Route::middleware(['auth:sanctum', "role:$admin|$user"])->group(function () use ($admin, $user) {
    Route::get('/logged-user', [UserController::class, 'getLoggedUser']);
});

// Admin routes
Route::prefix('/admin')->middleware(['auth:sanctum', "role:$admin"])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'getAdminReservationsList']);
});

// User routes
Route::middleware(['auth:sanctum', "role:$user"])->group(function () {
    Route::prefix('/reservations')->group(function () {
        Route::get('/', [ReservationController::class, 'getUserReservationsList']);
        Route::post('/', [ReservationController::class, 'postReservation']);
    });
});

// Unguarded routes
Route::prefix('/unguarded')->group(function () {
    Route::prefix('/reservations')->group(function () {
        Route::get('/', [ReservationController::class, 'getReservationsList']);
        Route::post('/', [ReservationController::class, 'postReservation']);
    });
});
