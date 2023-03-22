<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $carts = request()->user()->carts()->latest()->get();

        // get product price
        $prices = collect();

        foreach ($carts as $cart){
            $prices[] = $cart->product->price;
        }

        return view('order.carts', [
            'carts' => $carts,
            'total_price' => $prices->sum()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|integer'
        ]);

        Cart::firstOrCreate(['user_id' => $request->user()->id, 'product_id' => $validated['product_id']]);

        return back()->with('cart-saved', 'Produk berhasil disimpan ke dalam keranjang.');
    }

    /**
     * Display the specified resource.
     *
     * @param Cart $cart
     * @return Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cart $cart
     * @return Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Cart $cart
     * @return Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cart $cart
     * @return RedirectResponse
     */
    public function destroy(Cart $cart): RedirectResponse
    {
        $cart->delete();

        return back();
    }
}
