<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:50',
            'phone_number' => 'required|max:13',
            'detail' => 'required|string|max:255',
            'patokan' => 'required|string|max:50',
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180',
            'accuracy' => 'required|numeric',
        ];
    }
}
