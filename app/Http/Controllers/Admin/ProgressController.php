<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProgressOfAnOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    /*
     * Store progress of an order
     *
     */
    public function store(StoreProgressOfAnOrderRequest $request, Order $order)
    {
        // validating request
        $validated = $request->validated();

        // store image
        $path = $request->file('image')->store('public/progresses');
        $validated['image'] = $path;
        $validated['image_url'] = \Storage::url($path);

        // store progress
        $order->progresses()->create($validated);

        // redirect
        return back()->with('success', 'Progress berhasil ditambahkan.');
    }
}
