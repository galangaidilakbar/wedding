<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payments;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePaymentRequest;
use Illuminate\Http\RedirectResponse;

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

        return view('order.payment.create', ['order' => $order]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePaymentRequest $request
     * @return RedirectResponse
     */
    public function store(Order $order, StorePaymentRequest $request)
    {
        $validated = $request->validated();

        $path = $request->file('proof_of_payment')->store('public/payments');

        $validated['proof_of_payment'] = $path;

        $validated['proof_of_payment_url'] = Storage::url($path);

        $order->payments()->create($validated);

        $order->update(['status' => 'Melakukan Verifikasi']);

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
     * @param  \App\Models\Payments  $payments
     * @return Response
     */
    public function show(Payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payments  $payments
     * @return Response
     */
    public function edit(Payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Payments  $payments
     * @return Response
     */
    public function update(Request $request, Payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payments  $payments
     * @return Response
     */
    public function destroy(Payments $payments)
    {
        //
    }
}
