<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UpdatableStatusOrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Order $order)
    {
        // validate request
        $validated = $request->validate([
            'status' => ['required', 'in:' . implode(',', Order::ORDER_STATUS)],
        ]);

        // update order status
        $order->update([
            'status' => $validated['status'],
            // TODO: change status color based on status.
            'status_color' => 'gray',
        ]);

        // create order timeline

        $order->timelines()->create([
            'title' => 'Pesanan ' . $validated['status'] . '.',
            'description' => 'Status pesanan diperbarui oleh Admin.',
        ]);

        // redirect back
        return back()->with('order-status', 'order-updated');
    }
}
