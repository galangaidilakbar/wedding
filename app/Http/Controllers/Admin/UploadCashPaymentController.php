<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCashPaymentRequest;
use App\Models\Order;
use App\Models\Payments;
use App\Services\GetStatusColorOfAnOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UploadCashPaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Order $order, StoreCashPaymentRequest $request, GetStatusColorOfAnOrder $statusColorOfAnOrder): RedirectResponse
    {
        // validate request
        $validated = $request->validated();

        // store file
        $path = $request->file('proof_of_payment')->store('public/payments');
        $validated['proof_of_payment'] = $path;
        $validated['proof_of_payment_url'] = Storage::url($path);

        // since payment is cash, set status to accepted
        $validated['status'] = Payments::STATUS['PAYMENT_ACCEPTED'];

        // make note
        $validated['note'] = 'Pembayaran telah diterima oleh Admin.';

        // store payment
        $order->payments()->create($validated);

        // update order status
        $order->update([
            'status' => $request->input('status'),
            'status_color' => $statusColorOfAnOrder->get($request->input('status')),
        ]);

        // create new timeline
        $order->timelines()->create([
            'title' => 'Pembayaran Diterima.',
            'description' => 'Pembayaran telah diterima oleh Admin.',
        ]);

        // redirect
        return back()->with('payment-status', 'payment-received');
    }
}
