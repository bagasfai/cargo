<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpeditionPriceRequest extends FormRequest
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
            'province_id' => ['required', 'exists:provinces,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'district_id' => ['nullable', 'exists:districts,id'],
            'village_id' => ['nullable', 'exists:villages,id'],
            'code' => ['nullable', 'string', 'max:50'],
            'price_per_kg' => ['required', 'numeric', 'min:0'],
            'min_weight' => ['required', 'integer', 'min:1'],
            'estimated_delivery_time' => ['required', 'string', 'max:100'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'province_id.required' => 'Province is required.',
            'city_id.required' => 'City is required.',
            'price_per_kg.required' => 'Price per kg is required.',
            'min_weight.required' => 'Minimum weight is required.',
            'estimated_delivery_time.required' => 'Estimated delivery time is required.',
        ];
    }
}
