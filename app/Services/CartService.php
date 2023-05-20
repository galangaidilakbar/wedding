<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Collection;

class CartService
{
    // get cart of user
    public function getCartOfUser($user): Collection
    {
        return $user->carts()->latest()->get();
    }

    // get total product price
    public function getTotalProductPrice($carts)
    {
        $prices = collect();

        foreach ($carts as $cart) {
            $prices[] = $cart->product->price;
        }

        return $prices->sum();
    }

    // get price in DP
    public function getPriceInDP($price): float
    {
        return $price * Order::DP;
    }
}
