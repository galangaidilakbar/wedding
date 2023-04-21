<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Order;
use App\Models\Payments;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PaymentsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Order $order): View
    {
        abort_if($order->metode_pembayaran === 'CASH', 403, 'Metode pembayaran tidak sesuai');

        // abort if order status is not waiting for payment
        abort_if($order->status !== 'Menunggu Pembayaran', 403, 'Status pesanan tidak sesuai');

        return view('order.payment.create', ['order' => $order]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(Order $order, StorePaymentRequest $request)
    {
        $validated = $request->validated();

        $path = $request->file('proof_of_payment')->store('public/payments');

        $validated['proof_of_payment'] = $path;

        $validated['proof_of_payment_url'] = Storage::url($path);

        $order->payments()->create($validated);

        $order->update([
            'status' => 'Melakukan Verifikasi',
            'status_color' => 'blue',
        ]);

        // Create new timeline
        $order->timelines()->create([
            'title' => 'Mengunggah Bukti Bayar.',
            'description' => 'Menunggu verifikasi pembayaran dari admin.',
        ]);

        return to_route('order.show', $order);
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show(Payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(Payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(Request $request, Payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Payments $payments)
    {
        //
    }
}
