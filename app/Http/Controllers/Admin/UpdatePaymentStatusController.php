<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payments;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdatePaymentStatusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order, Payments $payment): RedirectResponse
    {
        $payment->update(['status' => $request->status]);

        return back();
    }
}
