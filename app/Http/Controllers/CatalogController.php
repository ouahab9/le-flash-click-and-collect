<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('active', true)
            ->orderBy('name')
            ->get();

        $products = Product::with('category')
            ->where('active', true)
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('catalog.index', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
