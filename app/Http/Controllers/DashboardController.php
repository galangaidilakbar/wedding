<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
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

        return view('dashboard', [
            'products' => $products->inRandomOrder()->paginate()->withQueryString(),
        ]);
    }
}
