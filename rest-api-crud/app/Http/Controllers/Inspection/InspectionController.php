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
        // Handle file uploads
        if ($request->hasFile('steering_attachment')) {
            $data['steering_attachment'] = $request->file('steering_attachment')->store('attachments');
        }

        if ($request->hasFile('brakes_attachment')) {
            $data['brakes_attachment'] = $request->file('brakes_attachment')->store('attachments');
        }

        if ($request->hasFile('lights_attachment')) {
            $data['lights_attachment'] = $request->file('lights_attachment')->store('attachments');
        }

        if ($request->hasFile('tires_attachment')) {
            $data['tires_attachment'] = $request->file('tires_attachment')->store('attachments');
        }
        
        $inspection = new Inspection();
        $inspection->fill([
            'user_id'=> $request->user_id,
            'vehicle_id'=> $request->vehicle_id,
            'inspection_date'=> $request->inspection_date,
            'steering'=> $request->steering,
            'steering_attachment' => $data['steering_attachment'],

            'brakes'=> $request->brakes,
            'brakes_attachment' => $data['brakes_attachment'],

            'lights'=> $request->lights,
            'lights_attachment' => $data['lights_attachment'],
            
            'tires'=> $request->tires,
            'tires_attachment' => $data['tires_attachment'],

        ]);
        $inspection->save();

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