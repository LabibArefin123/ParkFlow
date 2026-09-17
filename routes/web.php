<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkFlow\DashboardController;
use App\Http\Controllers\ParkFlow\ParkingMapController;
use App\Http\Controllers\ParkFlow\VehicleEntryController;
use App\Http\Controllers\ParkFlow\ActiveSessionController;
use App\Http\Controllers\ParkFlow\VehicleExitController;
use App\Http\Controllers\ParkFlow\RevenueController;

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');

    Route::get('/parking-map', [ParkingMapController::class, 'index'])
        ->name('parking.map');

    Route::get('/vehicle-entry', [VehicleEntryController::class, 'create'])
        ->name('vehicle.entry');

    Route::post('/vehicle-entry', [VehicleEntryController::class, 'store'])
        ->name('vehicle.entry.store');

    Route::get('/active-sessions', [ActiveSessionController::class, 'index'])
        ->name('sessions.active');

    Route::get('/vehicle-exit', [VehicleExitController::class, 'create'])
        ->name('vehicle.exit');

    Route::post('/vehicle-exit/{session}/complete', [VehicleExitController::class, 'complete'])
        ->name('vehicle.exit.complete');

    Route::get('/revenue', [RevenueController::class, 'index'])
        ->name('revenue.index');
});

Route::get('/', function () {
    return view('welcome');
});
