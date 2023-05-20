<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProgressOfAnOrderRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Storage;

class ProgressController extends Controller
{
    /*
     * Store progress of an order
     *
     */
    public function store(StoreProgressOfAnOrderRequest $request, Order $order): RedirectResponse
    {
        // validating request
        $validated = $request->validated();

        // store image
        $path = $request->file('image')->store('public/progresses');
        $validated['image'] = $path;
        $validated['image_url'] = Storage::url($path);

        // store progress
        $order->progresses()->create($validated);

        // redirect
        return back()->with('success', 'Progress berhasil ditambahkan.');
    }
}
