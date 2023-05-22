<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRescheduleRequest extends FormRequest
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
            'new_date' => 'required|date|after:today',
            'reason' => 'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'new_date.required' => 'New date is required',
            'new_date.date' => 'New date must be a date',
            'new_date.after' => 'New date must be after today',
            'reason.required' => 'Reason is required',
            'reason.string' => 'Reason must be a string',
            'reason.max' => 'Reason must not be more than 255 characters',
        ];
    }
}
