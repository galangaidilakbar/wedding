<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UploadTransferPaymentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Order $order): View
    {
        // abort if payment method is cash
        abort_if($order->metode_pembayaran === 'CASH', 403, 'Metode pembayaran tidak sesuai');

        // abort if order status is not waiting for payment
        abort_if($order->status !== 'Menunggu Pembayaran', 403, 'Status pesanan tidak sesuai');

        // return view to create payment
        return view('order.payment.create', ['order' => $order]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Order $order, StorePaymentRequest $request): RedirectResponse
    {
        // validate request
        $validated = $request->validated();

        // store proof of payment
        $path = $request->file('proof_of_payment')->store('public/payments');
        $validated['proof_of_payment'] = $path;
        $validated['proof_of_payment_url'] = Storage::url($path);

        // create new payment
        $order->payments()->create($validated);

        // update order status
        $order->update([
            'status' => 'Menunggu Konfirmasi',
            'status_color' => 'blue',
        ]);

        // Create new timeline
        $order->timelines()->create([
            'title' => 'Mengunggah Bukti Bayar.',
            'description' => 'Menunggu verifikasi pembayaran dari admin.',
        ]);

        return to_route('order.show', $order);
    }
}
