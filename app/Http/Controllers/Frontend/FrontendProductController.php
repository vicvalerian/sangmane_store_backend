<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendProductController extends Controller
{
    public function productIndex(Request $request)
    {
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->firstOrFail();
            $products = Product::withAvg('reviews', 'rating')->withCount('reviews')
                ->with(['product_variants', 'category', 'product_image_galleries'])
                ->where([
                    'status' => 1,
                    'is_approved' => 1,
                    'category_id' => $category->id,
                ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0] ?? 0;
                    $to = $price[1] ?? 8000;

                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } else if ($request->has('sub_category')) {
            $category = SubCategory::where('slug', $request->sub_category)->firstOrFail();
            $products = Product::withAvg('reviews', 'rating')->withCount('reviews')
                ->with(['product_variants', 'category', 'product_image_galleries'])
                ->where([
                    'status' => 1,
                    'is_approved' => 1,
                    'sub_category_id' => $category->id,
                ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0] ?? 0;
                    $to = $price[1] ?? 8000;

                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } else if ($request->has('child_category')) {
            $category = ChildCategory::where('slug', $request->child_category)->firstOrFail();
            $products = Product::withAvg('reviews', 'rating')->withCount('reviews')
                ->with(['product_variants', 'category', 'product_image_galleries'])
                ->where([
                    'status' => 1,
                    'is_approved' => 1,
                    'child_category_id' => $category->id,
                ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0] ?? 0;
                    $to = $price[1] ?? 8000;

                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } else if ($request->has('brand')) {
            $brand = Brand::where('slug', $request->brand)->firstOrFail();
            $products = Product::withAvg('reviews', 'rating')->withCount('reviews')
                ->with(['product_variants', 'category', 'product_image_galleries'])
                ->where([
                    'status' => 1,
                    'is_approved' => 1,
                    'brand_id' => $brand->id,
                ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0] ?? 0;
                    $to = $price[1] ?? 8000;

                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } else if ($request->has('search')) {
            $products = Product::withAvg('reviews', 'rating')->withCount('reviews')
                ->with(['product_variants', 'category', 'product_image_galleries'])
                ->where(['status' => 1, 'is_approved' => 1])
                ->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('long_description', 'like', '%' . $request->search . '%')
                        ->orWhereHas('category', function ($query) use ($request) {
                            $query->where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('long_description', 'like', '%' . $request->search . '%');
                        });
                })
                ->paginate(12);
        } else if ($request->has('top_category')) {
            $type = '';
            $id = '';
            $category = Category::where('slug', $request->top_category)->first();
            if ($category) {
                $type = 'category_id';
                $id = $category->id;
            }
            $category = SubCategory::where('slug', $request->top_category)->first();
            if ($category) {
                $type = 'sub_category_id';
                $id = $category->id;
            }
            $category = ChildCategory::where('slug', $request->top_category)->first();
            if ($category) {
                $type = 'child_category_id';
                $id = $category->id;
            }
            $products = Product::withAvg('reviews', 'rating')->withCount('reviews')
                ->with(['product_variants', 'category', 'product_image_galleries'])
                ->where([
                    'status' => 1,
                    'is_approved' => 1,
                    $type => $id,
                ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0] ?? 0;
                    $to = $price[1] ?? 8000;

                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } else {
            $products = Product::withAvg('reviews', 'rating')->withCount('reviews')
                ->with(['product_variants', 'category', 'product_image_galleries'])
                ->where(['status' => 1, 'is_approved' => 1])->orderBy('id', 'desc')->paginate(12);
        }

        $categories = Category::where(['status' => 1])->get();
        $brands = Brand::where(['status' => 1])->get();

        $productpage_banner_section = Advertisement::where('key', 'productpage_banner_section')->first();
        $productpage_banner_section = json_decode($productpage_banner_section?->value);

        return view('frontend.pages.product', compact(
            'products',
            'categories',
            'brands',
            'productpage_banner_section',
        ));
    }

    public function showProduct(string $slug)
    {
        $product = Product::with(['vendor', 'category', 'product_image_galleries', 'product_variants', 'brand'])->where('slug', $slug)->where('status', 1)->first();
        $reviews = ProductReview::where('product_id', $product->id)->where('status', 1)->paginate(10);
        $vendorRating = $this->getVendorRatingAttribute($product->vendor);

        return view('frontend.pages.product-detail', compact(
            'product',
            'reviews',
            'vendorRating',
        ));
    }

    public function changeListView(Request $request)
    {
        Session::put('product_list_style', $request->style);
    }

    private function getVendorRatingAttribute($vendor)
    {
        $products = $vendor->products()->with('reviews')->get();

        $totalRatings = 0;
        $totalProducts = 0;

        $vendorRating['totalRatings'] = 0;
        $vendorRating['totalProducts'] = 0;

        foreach ($products as $product) {
            if (count($product->reviews) > 0) {
                $totalProducts++;
            }
            $totalRatings += $product->reviews->avg('rating') != null ? $product->reviews->avg('rating') : 0;
        }
        $vendorRating['totalRatings'] = ($totalProducts > 0) ? $totalRatings / $totalProducts : 0;
        $vendorRating['totalProducts'] = $totalProducts;

        return $vendorRating;
    }

    private function getVendorRatingCountAttribute($vendor)
    {
        $products = $vendor->products()->with('reviews')->get();

        $count = 0;

        foreach ($products as $product) {
            if (count($product->reviews) > 0) {
                $count++;
            }
        }

        return $count;
    }
}
