<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('order.index', [
            'orders' => auth()->user()->isAdmin()
                ? Order::with('detail_orders.product')->get()
                : auth()->user()->orders()->with('detail_orders.product')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     */
    public function create(): View
    {
        abort_if($this->getCarts()->isEmpty(), 403, trans('translations.carts_is_empty'));

        return view('order.create', [
            'carts' => $this->getCarts(),
            'addresses' => auth()->user()->addresses()->get(),
            'total_product_price' => $this->getTotalProductPrice(),
            'total_pembayaran_dengan_dp' => $this->getTotalPembayaranDenganDP(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $validated['total_harga'] = $this->getTotalProductPrice();
        $validated['total_dp'] = $this->getTotalPembayaranDenganDP();
        $order = Order::create($validated);

        // Create detail order and delete carts
        foreach ($this->getCarts() as $cart) {
            $order->detail_orders()->create(['product_id' => $cart->product_id]);
            $cart->delete();
        }

        // Create timeline
        $order->timelines()->create(['title' => 'Pesanan Dibuat.']);

        return to_route('order.show', $order)->with('order-status', 'order-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): View
    {
        $this->authorize('view', $order);

        return view('order.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return to_route('order.index');
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
