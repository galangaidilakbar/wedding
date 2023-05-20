<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\GetStatusColorOfAnOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdatableStatusOrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Order $order, GetStatusColorOfAnOrder $statusColorOfAnOrder)
    {
        // validate request
        $validated = $request->validate([
            'status' => ['required', 'in:'.implode(',', Order::ORDER_STATUS)],
        ]);

        // update order status
        $order->update([
            'status' => $validated['status'],
            'status_color' => $statusColorOfAnOrder->get($validated['status']),
        ]);

        // create order timeline
        $order->timelines()->create([
            'title' => 'Pesanan '.$validated['status'].'.',
            'description' => 'Status pesanan diperbarui oleh Admin.',
        ]);

        // redirect back
        return back()->with('order-status', 'order-updated');
    }
}
