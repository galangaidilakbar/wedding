<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $products = Product::query();

        // get the search value from the request
        $search = $request->input('search');

        // search product by name, description or id
        $products->when($search, function ($q) use ($search) {
            $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%')
                ->orWhere('id', $search);
        });

        return view('product.index', [
            'products' => $products->paginate()->withQueryString(),
            'keyword' => $search,
        ]);
    }
}
