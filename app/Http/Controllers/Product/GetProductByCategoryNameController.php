<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class GetProductByCategoryNameController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        $category = Category::where('name', 'like', '%' . $request->name . '%')->with('products')->get();

        abort_if($category->isEmpty(), 404, 'Category not found');

        return view('dashboard', [
            'show_all_products' => true,
            'categories' => $category
        ]);
    }
}
