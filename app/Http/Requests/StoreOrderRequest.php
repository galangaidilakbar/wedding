<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'address_id' => 'required',
            'tanggal_acara' => 'required|date|after: +2 weeks',
            'opsi_bayar' => 'required',
            'metode_pembayaran' => 'required',
            'catatan' => 'nullable',
        ];
    }

    // messages
    public function messages(): array
    {
        return [
            'address_id.required' => 'Alamat harus diisi',
            'tanggal_acara.required' => 'Tanggal acara harus diisi',
            'tanggal_acara.date' => 'Tanggal acara harus berupa tanggal',
            'tanggal_acara.after' => 'Tanggal acara harus lebih dari 2 minggu dari hari ini',
            'opsi_bayar.required' => 'Opsi pembayaran harus diisi',
            'metode_pembayaran.required' => 'Metode pembayaran harus diisi',
        ];
    }
}
