<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('is-admin');

        return view('admin.product.index', [
            'products' => Product::with('category')->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('is-admin');

        return view('admin.product.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
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

        return to_route('admin.products.index')->with('status', 'produk berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show(Product $product): View
    {
        return view('product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $this->authorize('is-admin');

        return view('admin.product.edit', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
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

        return to_route('admin.products.index')->with('status', 'produk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('is-admin');

        Storage::delete($product->photo);

        $product->delete();

        return to_route('admin.products.index')->with('status', 'produk berhasil dihapus');
    }
}
