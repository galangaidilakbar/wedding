<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\ProductRecommendations;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductRecommendations $productRecommendations): View
    {
        $carts = request()->user()->carts()->latest()->get();

        // get product price
        $prices = collect();

        foreach ($carts as $cart) {
            $prices[] = $cart->product->price;
        }

        Log::info('Showing the shopping cart for user: '.request()->user()->id);

        return view('cart', [
            'carts' => $carts,
            'total_price' => $prices->sum(),
            'recommendations' => $productRecommendations->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product, Request $request): RedirectResponse
    {
        Cart::firstOrCreate([
            'user_id' => $request->user()->id,
            'product_id' => $product->id,
        ]);

        Log::info('Save the product into the shopping cart', ['user_id' => $request->user()->id, 'product_id' => $product->id]);

        return to_route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart): RedirectResponse
    {
        $cart->delete();

        Log::info('Delete the product from shopping cart', ['user_id' => $cart->user_id, 'product_id' => $cart->product_id]);

        return back();
    }
}
