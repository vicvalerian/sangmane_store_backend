<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSale = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $popularCategory = HomePageSetting::where('key', 'popular_category_section')->first();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
        $typeBaseProducts = $this->getTypeBaseProducts();
        $categoryProductSliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        $categoryProductSliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();
        $categoryProductSliderSectionThree = HomePageSetting::where('key', 'product_slider_section_three')->first();

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
        ));
    }

    public function getTypeBaseProducts()
    {
        $typeBaseProducts = [];
        $typeBaseProducts['new_arrival'] = Product::where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'desc')->take(8)->get();
        $typeBaseProducts['featured_product'] = Product::where(['product_type' => 'featured_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'desc')->take(8)->get();
        $typeBaseProducts['top_product'] = Product::where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'desc')->take(8)->get();
        $typeBaseProducts['best_product'] = Product::where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'desc')->take(8)->get();

        return $typeBaseProducts;
    }
}
