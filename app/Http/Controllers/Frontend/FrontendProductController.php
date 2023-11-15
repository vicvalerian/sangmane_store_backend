<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    public function showProduct(string $slug)
    {
        $product = Product::with(['vendor', 'category', 'product_image_galleries', 'product_variants', 'brand'])->where('slug', $slug)->where('status', 1)->first();

        return view('frontend.pages.product-detail', compact(
            'product',
        ));
    }
}
