<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InspectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'steering' => filter_var($this->steering, FILTER_VALIDATE_BOOLEAN),
            'brakes' => filter_var($this->brakes, FILTER_VALIDATE_BOOLEAN),
            'lights' => filter_var($this->lights, FILTER_VALIDATE_BOOLEAN),
            'tires' => filter_var($this->tires, FILTER_VALIDATE_BOOLEAN),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'inspection_date' => 'required|date',
            'steering' => 'required|boolean',
            'steering_attachment' => 'nullable|file|mimes:jpeg,png|max:10240', // Max 10MB
            'brakes' => 'required|boolean',
            'brakes_attachment' => 'nullable|file|mimes:jpeg,png|max:10240',
            'lights' => 'required|boolean',
            'lights_attachment' => 'nullable|file|mimes:jpeg,png|max:10240',
            'tires' => 'required|boolean',
            'tires_attachment' => 'nullable|file|mimes:jpeg,png|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User ID is required',
            'user_id.exists' => 'User ID does not exist',
            'vehicle_id.required' => 'Vehicle ID is required',
            'vehicle_id.exists' => 'Vehicle ID does not exist',
            'inspection_date.required' => 'Inspection date is required',
            'steering.required' => 'Steering condition is required',
            'steering_attachment.required_if' => 'Steering attachment is required if steering condition is false',
            'brakes.required' => 'Brakes condition is required',
            'brakes_attachment.required_if' => 'Brakes attachment is required if brakes condition is false',
            'lights.required' => 'Lights condition is required',
            'lights_attachment.required_if' => 'Lights attachment is required if lights condition is false',
            'tires.required' => 'Tires condition is required',
            'tires_attachment.required_if' => 'Tires attachment is required if tires condition is false',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = response()->json([
           'success' => false,
           'message' => $validator->errors()
        ],403);

        throw new HttpResponseException($response);
    }
}