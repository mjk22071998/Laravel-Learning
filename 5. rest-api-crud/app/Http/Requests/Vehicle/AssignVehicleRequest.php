<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AssignVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,id',
        ];
    }

    public function messages(){
        return [
            'vehicle_id.required' => 'Vehicle must be selected',
            'vehicle_id.exists:vehicles,id' => 'Vehicle does not exist',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = response()->json([
           'success' => false,
           'message' => $validator->errors()->first()
        ], 400);

        throw new HttpResponseException($response);
    }
}