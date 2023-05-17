<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCashPaymentRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UploadCashPaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Order $order, StoreCashPaymentRequest $request)
    {
        // validate request
        $validated = $request->validated();

        // store file
        $path = $request->file('proof_of_payment')->store('public/payments');

        $validated['proof_of_payment'] = $path;

        $validated['proof_of_payment_url'] = Storage::url($path);

        $validated['status'] = 'Diterima';

        $validated['note'] = 'Pembayaran telah diterima Admin.';

        // store payment
        $order->payments()->create($validated);

        // update order status
        $order->update(['status' => $request->status]);

        // redirect
        return back();
    }
}
