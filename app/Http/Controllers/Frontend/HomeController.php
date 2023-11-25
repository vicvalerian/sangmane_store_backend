<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Cache::rememberForever('sliders', function () {
            return Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        });
        $flashSale = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->pluck('product_id')->toArray();
        $popularCategory = HomePageSetting::where('key', 'popular_category_section')->first();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
        $typeBaseProducts = $this->getTypeBaseProducts();
        $categoryProductSliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        $categoryProductSliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();
        $categoryProductSliderSectionThree = HomePageSetting::where('key', 'product_slider_section_three')->first();

        // banner
        $homepage_section_banner_one = Advertisement::where('key', 'homepage_section_banner_one')->first();
        $homepage_section_banner_one = json_decode($homepage_section_banner_one?->value);

        $homepage_section_banner_two = Advertisement::where('key', 'homepage_section_banner_two')->first();
        $homepage_section_banner_two = json_decode($homepage_section_banner_two?->value);

        $homepage_section_banner_three = Advertisement::where('key', 'homepage_section_banner_three')->first();
        $homepage_section_banner_three = json_decode($homepage_section_banner_three?->value);

        $homepage_section_banner_four = Advertisement::where('key', 'homepage_section_banner_four')->first();
        $homepage_section_banner_four = json_decode($homepage_section_banner_four?->value);

        $recentBlogs = Blog::with(['category', 'user'])->where('status', 1)->orderBy('id', 'desc')->take(8)->get();

        return view('frontend.home.home', compact(
            'sliders',
            'flashSale',
            'flashSaleItems',
            'popularCategory',
            'brands',
            'typeBaseProducts',
            'categoryProductSliderSectionOne',
            'categoryProductSliderSectionTwo',
            'categoryProductSliderSectionThree',
            'homepage_section_banner_one',
            'homepage_section_banner_two',
            'homepage_section_banner_three',
            'homepage_section_banner_four',
            'recentBlogs',
        ));
    }

    public function getTypeBaseProducts()
    {
        $typeBaseProducts = [];
        $typeBaseProducts['new_arrival'] = Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['product_variants', 'category', 'product_image_galleries'])
            ->where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        $typeBaseProducts['featured_product'] = Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['product_variants', 'category', 'product_image_galleries'])
            ->where(['product_type' => 'featured_product', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        $typeBaseProducts['top_product'] = Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['product_variants', 'category', 'product_image_galleries'])
            ->where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        $typeBaseProducts['best_product'] = Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['product_variants', 'category', 'product_image_galleries'])
            ->where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        return $typeBaseProducts;
    }

    public function vendorPage()
    {
        $vendors = Vendor::where('status', 1)->paginate(20);
        return view('frontend.pages.vendor', compact('vendors'));
    }

    public function vendorProductsPage(string $id)
    {
        $products = Product::withAvg('reviews', 'rating')->withCount('reviews')
            ->with(['product_variants', 'category', 'product_image_galleries'])->where(['status' => 1, 'is_approved' => 1, 'vendor_id' => $id])->orderBy('id', 'DESC')->paginate(12);
        $categories = Category::where(['status' => 1])->get();
        $brands = Brand::where(['status' => 1])->get();
        $vendor = Vendor::findOrFail($id);

        return view('frontend.pages.vendor-product', compact('products', 'categories', 'brands', 'vendor'));
    }

    function showProductModal(string $id)
    {
        $product = Product::findOrFail($id);

        $content = view('frontend.layouts.modal', compact('product'))->render();

        return Response::make($content, 200, ['Content-Type' => 'text/html']);
    }
}
