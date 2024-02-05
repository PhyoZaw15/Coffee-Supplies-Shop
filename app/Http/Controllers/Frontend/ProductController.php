<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->cat_id != null) {
            $products = Product::where('category_id', $request->cat_id)->get();
            return view('frontend.products.index', compact('products'));
        }

        $products = Product::all();
        return view('frontend.products.index', compact('products'));
    }
}
