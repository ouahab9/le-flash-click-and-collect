<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(20);

        return view('admin.products.index', [
            'products' => $products,
        ]);
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'active' => ['nullable', 'boolean'],
            'age_restricted' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $validated['active'] = $request->boolean('active');

        $validated['age_restricted'] =
            $request->boolean('age_restricted');

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produit créé avec succès.'
            );
    }

    public function show(Product $product): View
    {
        $product->load('category');

        return view('admin.products.show', [
            'product' => $product,
        ]);
    }

    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(
        Request $request,
        Product $product
    ): RedirectResponse {
        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'active' => ['nullable', 'boolean'],
            'age_restricted' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $validated['active'] =
            $request->boolean('active');

        $validated['age_restricted'] =
            $request->boolean('age_restricted');

        if ($request->hasFile('image')) {

            if (
                $product->image &&
                Storage::disk('public')->exists($product->image)
            ) {
                Storage::disk('public')
                    ->delete($product->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('products', 'public');

        } else {
            unset($validated['image']);
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produit modifié avec succès.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | MODIFICATION RAPIDE DU STOCK
    |--------------------------------------------------------------------------
    */

    public function updateStock(
        Request $request,
        Product $product
    ): RedirectResponse {
        $validated = $request->validate([
            'change' => [
                'required',
                'integer',
                'in:-5,-1,1,5',
            ],
        ]);

        $change = (int) $validated['change'];

        /*
        |--------------------------------------------------------------------------
        | CALCUL DU NOUVEAU STOCK
        |--------------------------------------------------------------------------
        |
        | max(0, ...) empêche le stock de devenir négatif.
        |
        */

        $newStock = max(
            0,
            $product->stock + $change
        );

        $product->update([
            'stock' => $newStock,
        ]);

        return back()->with(
            'success',
            'Stock de "' .
            $product->name .
            '" mis à jour : ' .
            $newStock .
            ' unité(s).'
        );
    }

    public function destroy(
        Product $product
    ): RedirectResponse {

        if (
            $product->image &&
            Storage::disk('public')->exists($product->image)
        ) {
            Storage::disk('public')
                ->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produit supprimé avec succès.'
            );
    }
}