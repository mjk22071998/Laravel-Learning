<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Http\Requests\Vehicle\AssignVehicleRequest;


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
        $user = User::findOrFail($userId);

        $vehicle = Vehicle::findOrFail($user->vehicle_id);

        $user->assignedVehicles()->attach($vehicle->id);

        return response()->json([
            'message' => 'Vehicle assigned successfully',
        ], 200);
    }

    public function getAssignedVehicles($userId)
    {
        $user = User::findOrFail($userId);

        return response()->json([
            'vehicles' => $user->assignedVehicles,
        ], 200);
    }
}