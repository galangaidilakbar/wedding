<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
            'name' => 'required|string|max:50',
            'detail' => 'required|string|max:255',
            'keterangan', 'nullable|string|max:50',
            'latitude' => 'nullable|between:-90,90',
            'longitude' => 'nullable|between:-180,180',
            'accuracy' => 'nullable|numeric',
        ];
    }
}
