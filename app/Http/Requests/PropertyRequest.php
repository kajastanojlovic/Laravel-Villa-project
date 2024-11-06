<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'total_space'=>'required|integer|min:1',
            'number_of_bathrooms'=>'required|integer|min:1',
            'number_of_bedrooms'=>'required|integer|min:1',
            'number_of_floors'=>'required|integer|min:1',
            'type_id'=>'required|exists:real_estate_types,id',
            'details'=>'required'
        ];
    }
}
