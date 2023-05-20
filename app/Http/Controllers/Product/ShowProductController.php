<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductRecommendations;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShowProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Product $product, ProductRecommendations $productRecommendations): View
    {
        return view('product.show', [
            'product' => $product,
            'recommendations' => $productRecommendations->get(),
        ]);
    }
}
