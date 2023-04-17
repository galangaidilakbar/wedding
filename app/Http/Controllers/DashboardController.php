<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'categories' => Category::with('products')->get(),
            'show_all_products' => false,
        ]);
    }
}
