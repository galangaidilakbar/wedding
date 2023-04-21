<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\ProductRecommendations;

class ShowProductController extends Controller
{
    private ProductRecommendations $productRecommendations;

    public function __construct(ProductRecommendations $productRecommendations)
    {
        $this->productRecommendations = $productRecommendations;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Product $product): View
    {
        return view('product.show', [
            'product' => $product,
            'recommendations' => $this->productRecommendations->get(),
        ]);
    }
}
