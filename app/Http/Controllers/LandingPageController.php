<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): view
    {
        $products = Product::query();

        if (request()->has('sort')) {
            if (request()->sort === 'lowest_price') {
                $products->orderBy('price');
            } elseif (request()->sort === 'highest_price') {
                $products->orderByDesc('price');
            } elseif (request()->sort === 'newest') {
                $products->orderByDesc('created_at');
            } elseif (request()->sort === 'oldest') {
                $products->orderBy('created_at');
            }
        }

        return view('index', [
            'products' => $products->inRandomOrder()->paginate()->withQueryString(),
        ]);
    }
}
