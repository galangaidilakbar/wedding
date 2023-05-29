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

        // init final price to total_price
        $final_price = $order->total_harga;

        // if user just create an order and opsi bayar is DP, set final price to total_dp
        if ($order->status === Order::ORDER_STATUS['WAITING_FOR_PAYMENT'] && $order->opsi_bayar === 'DP') {
            $final_price = $order->total_dp;
        }

        // if user already paid an order with opsi bayar dp, the final price will be total_harga - total_dp
        if ($order->status === Order::ORDER_STATUS['WAITING_FOR_REMAINING_PAYMENT'] && $order->opsi_bayar === 'DP') {
            $final_price = $order->total_harga - $order->total_dp;
        }

        // return view to create payment
        return view('order.payment.create', compact('order', 'final_price'));
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
