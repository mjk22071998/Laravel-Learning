<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VehicleRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'color' => 'required|string|max:255',
            'price' => 'required|numeric',
        ];
    }

     public function messages(){
        return [
            'name.required' => 'Vehicle Name is required',
            'name.string'=> 'Vehicle Name must be a string',
            'name.max' => 'Vehicle Name must be less than 255 characters',
            'brand.required' => 'Vehicle Brand is required',
            'brand.string'=> 'Vehicle Brand must be a string',
            'brand.max' => 'Vehicle Brand must be less than 255 characters',
            'model.required' => 'Vehicle Model is required',
            'model.string'=> 'Vehicle Model must be a string',
            'model.max' => 'Vehicle Model must be less than 255 characters',
            'year.required' => 'Vehicle Year is required',
            'year.integer'=> 'Vehicle Year must be an integer',
            'color.required' => 'Vehicle Color is required',
            'color.string'=> 'Vehicle Color must be a string',
            'color.max' => 'Vehicle Color must be less than 255 characters',
            'price.required' => 'Vehicle Price is required',
            'price.numeric'=> 'Vehicle Price must be a number',
        ];
     }

    public function failedValidation(Validator $validator)
    {
        $response = response()->json([
           'success' => false,
           'message' => $validator->errors()->first()
        ]);

        throw new HttpResponseException($response);
    }
}