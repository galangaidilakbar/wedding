<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $this->authorize('is-admin');

        return view('product.index', ['products' => Product::with('category')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $this->authorize('is-admin');

        return view('product.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $this->authorize('is-admin');

        $validated = $request->all();

        // store the product image
        $path = $request->file('photo')->store('public/products');
        $validated['photo'] = $path;
        $validated['photo_url'] = Storage::url($path);

        Product::create($validated);

        return to_route('product.index')->with('status', 'produk berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product): View
    {
        return view('product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $this->authorize('is-admin');

        return view('product.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $this->authorize('is-admin');

        $validated = $request->all();

        if ($request->hasFile('photo')) {
            Storage::delete($product->photo);
            $path = $request->file('photo')->store('public/products');
            $validated['photo'] = $path;
            $validated['photo_url'] = Storage::url($path);
        }

        $product->update($validated);

        return to_route('product.index')->with('status', 'produk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('is-admin');

        Storage::delete($product->photo);

        $product->delete();

        return to_route('product.index')->with('status', 'produk berhasil dihapus');
    }
}
