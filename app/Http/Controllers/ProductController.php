<?php


namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $products = Product::query()
            ->where('published', '=', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
        return view('product.index', [
            'products' => $products
        ]);
    }

    public function view(Product $product): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('product.view', ['product' => $product]);
    }
}
