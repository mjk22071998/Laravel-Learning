<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Vehicle\VehicleController;
use App\Http\Controllers\Inspection\InspectionController;

Route::get('/test', function (Request $request) {
    return 'test';
});

// Auth Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Getting driver routes
Route::get('getDrivers', [UserController::class, 'getDrivers']);

// Asigning vahicles
Route::post('users/{userId}/assign-vehicle', [UserController::class, 'assignVehicle']);
Route::get('users/{userId}/assigned-vehicles', [UserController::class, 'getAssignedVehicles']);

// Vehicle routes
Route::apiResource('vehicles', VehicleController::class, ['except' => ['show']]);

// Inspection routes
Route::apiResource('inspections', InspectionController::class, ['except' => ['show']]);