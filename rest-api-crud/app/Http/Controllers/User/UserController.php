<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Http\Requests\AssignVehicleRequest;


class UserController extends Controller
{
    public function getDrivers()
    {
        $drivers = User::role('driver')->get();

        return response()->json([
            'success' => true,
            'data' => $drivers,
        ]);
    }

    public function assignVehicle(AssignVehicleRequest $request, $userId)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'error' => 'User not found',
            ], 404);
        }

        $vehicle = Vehicle::find($validated['vehicle_id']);

        if (!$vehicle) {
            return response()->json([
                'error' => 'Vehicle not found',
            ], 404);
        }

        $user->assignedVehicles()->attach($vehicle->id);

        return response()->json([
            'message' => 'Vehicle assigned successfully',
        ], 200);
    }

    public function getAssignedVehicles($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'error' => 'User not found',
            ], 404);
        }

        $vehicles = $user->assignedVehicles;

        return response()->json([
            'vehicles' => $vehicles,
        ], 200);
    }
}