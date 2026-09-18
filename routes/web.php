<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\ParkingMapController;
use App\Http\Controllers\ParkingLocationController;
use App\Http\Controllers\ParkingSpotController;
use App\Http\Controllers\VehicleEntryController;
use App\Http\Controllers\ActiveSessionController;
use App\Http\Controllers\VehicleExitController;
use App\Http\Controllers\RevenueController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/admin', [AdministrationController::class, 'index'])->name('administration');
    Route::resource('parking_locations', ParkingLocationController::class);
    Route::resource('parking_spots', ParkingSpotController::class);
    Route::get('/parking-map', [ParkingMapController::class, 'index'])->name('parking.map');

    Route::get('/vehicle-entry', [VehicleEntryController::class, 'create'])->name('vehicle.entry');
    Route::post('/vehicle-entry', [VehicleEntryController::class, 'store'])->name('vehicle.entry.store');

    Route::get('/active-sessions', [ActiveSessionController::class, 'index'])->name('sessions.active');

    Route::get('/vehicle-exit', [VehicleExitController::class, 'create'])->name('vehicle.exit');
    Route::post('/vehicle-exit/{session}/complete', [VehicleExitController::class, 'complete'])->name('vehicle.exit.complete');

    Route::get('/revenue', [RevenueController::class, 'index'])->name('revenue.index');
});

Route::get('/', function () {
    return redirect()->route('dashboard');
});
