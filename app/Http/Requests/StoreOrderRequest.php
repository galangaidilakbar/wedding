<?php

namespace App\Http\Requests;

use App\Models\Order;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

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
            'tanggal_acara' => 'required|date|after: +1 month',
            'opsi_bayar' => 'required',
            'metode_pembayaran' => 'required',
            'catatan' => 'nullable',
        ];
    }

    /**
     * @throws Exception
     */
    public function checkAvailability(string $date): void
    {
        $order = Order::whereDate('tanggal_acara', $date)
            ->whereNot('status', Order::ORDER_STATUS['CANCELLED'])
            ->count();

        if ($order >= 2) {
            throw ValidationException::withMessages(['tanggal_acara' => 'Tanggal acara sudah penuh']);
        }
    }

    // messages
    public function messages(): array
    {
        return [
            'address_id.required' => 'Alamat harus diisi',
            'tanggal_acara.required' => 'Tanggal acara harus diisi',
            'tanggal_acara.date' => 'Tanggal acara harus berupa tanggal',
            'tanggal_acara.after' => 'Tanggal acara harus lebih dari 1 bulan dari hari ini',
            'opsi_bayar.required' => 'Opsi pembayaran harus diisi',
            'metode_pembayaran.required' => 'Metode pembayaran harus diisi',
        ];
    }
}
