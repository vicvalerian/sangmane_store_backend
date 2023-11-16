<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $variants = [];
        $variantTotalAmount = 0;

        if ($request->has('variant_items')) {
            foreach ($request->variant_items as $id) {
                $variantItem = ProductVariantItem::findOrFail($id);
                $variants[$variantItem->product_variant->name]['name'] = $variantItem->name;
                $variants[$variantItem->product_variant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }

        // check discount
        $productTotalAmount = 0;
        if (checkDiscount($product)) {
            $productTotalAmount = ($product->offer_price + $variantTotalAmount);
        } else {
            $productTotalAmount = ($product->price + $variantTotalAmount);
        }

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productTotalAmount;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;

        Cart::add($cartData);

        return response([
            'status' => 'success',
            'message' => 'Product added to cart successfully!'
        ]);
    }
}
