<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Requests\VehicleRequest;

class VehicleController extends Controller
{
    /**
     * Get all vehicles.
     */
    public function index()
    {
        $vehicles = Vehicle::all();

        return response()->json([
            'success' => true,
            'data' => $vehicles,
        ],200);
    }

    /**
     * Add a new vehicle.
     */
    public function store(VehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Vehicle created successfully.',
            'data' => $vehicle,
        ],200);
    }

    /**
     * Update an existing vehicle.
     */
    public function update(VehicleRequest $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Vehicle updated successfully.',
            'data' => $vehicle,
        ],200);
    }

    /**
     * Delete a vehicle.
     */
    public function destroy($id)
    {
        Vehicle::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Vehicle deleted successfully.',
        ],200);
    }
}