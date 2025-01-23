<?php

namespace App\Http\Controllers\Inspection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inspection;
use App\Http\Requests\InspectionRequest;

class InspectionController extends Controller
{

    public function index(){
        $inspections = Inspection::all();
         return response()->json([
            'message' => 'Inspection retrieved successfully.',
            'inspections' => $inspections
        ], status: 200);
    }

    /**
     * Store a newly created inspection in storage.
     */
    public function store(InspectionRequest $request)
    {
        $inspection = Inspection::create($request->all());

        return response()->json([
            'message' => 'Inspection created successfully.',
            'inspection' => $inspection
        ], status: 201);
    }

    /**
     * Update the specified inspection in storage.
     */
    public function update(InspectionRequest $request, $id)
    {
        $inspection = Inspection::find($id);

        if (!$inspection) {
            return response()->json(['message' => 'Inspection not found'], 404);
        }

        $inspection->update($request->all());

        return response()->json([
            'message' => 'Inspection updated successfully.',
            'inspection' => $inspection
        ], 200);
    }
}