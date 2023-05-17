<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payments;
use Illuminate\Http\Request;

class UpdatePaymentStatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Order $order, Payments $payment)
    {
        $payment->update(['status' => $request->status]);

        return back();
    }
}
