<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('is-admin');

        return view('admin.category.index', [
            'categories' => Category::withCount('products')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->authorize('is-admin');

        Category::create($request->validated());

        return back()->with('status', 'saved');
    }

    /**
     * Show the category and products that attached to it.
     */
    public function show(Category $category): View
    {
        $products = $category->products();

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

        return view('category.show', [
            'category' => $category,
            'products' => $products->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        $this->authorize('is-admin');

        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category): RedirectResponse
    {
        $this->authorize('is-admin');

        $category->update($request->validated());

        return to_route('admin.categories.index')->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('is-admin');

        $category->delete();

        return back()->with('status', 'deleted');
    }
}
