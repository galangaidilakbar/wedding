<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('order.index', [
            'orders' => request()->user()->orders()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $addresses = request()->user()->addresses()->get();
        abort_if($addresses->isEmpty(), 403, trans('translations.address_is_empty'));
        abort_if($this->getCarts()->isEmpty(), 403, trans('translations.carts_is_empty'));

        return view('order.create', [
            'carts' => $this->getCarts(),
            'addresses' => $addresses,
            'total_product_price' => $this->getTotalProductPrice(),
            'total_pembayaran_dengan_dp' => $this->getTotalPembayaranDenganDP(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     * @return Response
     */
    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $validated['total_harga'] = $this->getTotalProductPrice();
        $validated['status'] = 'pending';
        $order = Order::create($validated);
        foreach ($this->getCarts() as $cart) {
            $order->detail_orders()->create(['product_id' => $cart->product_id]);
            $cart->delete();
        }

        return 'order created, detail order saved';
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     * @return Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Order $order
     * @return Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\Order $order
     * @return Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $order
     * @return Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function getCarts(): Collection
    {
        return request()->user()->carts()->with('product')->get();
    }

    public function getTotalProductPrice(): int|float
    {
        $prices = collect();
        foreach ($this->getCarts() as $cart) {
            $prices[] = $cart->product->price;
        }
        return $prices->sum();
    }

    public function getTotalPembayaranDenganDP(): int|float
    {
        return $this->getTotalProductPrice() * Order::DP;
    }
}
