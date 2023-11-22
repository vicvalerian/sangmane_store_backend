<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\FooterGridThreeController;
use App\Http\Controllers\Backend\FooterGridTwoController;
use App\Http\Controllers\Backend\FooterInfoController;
use App\Http\Controllers\Backend\FooterSocialController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RazorpaySettingController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TransactionController;
use Illuminate\Support\Facades\Route;

//Admin Routes
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

//Profile Routes
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

//Slider Routes
Route::resource('slider', SliderController::class);

//Category Routes
Route::put('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

//Sub Category Routes
Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);

//Child Category Routes
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('sub-category-list', [ChildCategoryController::class, 'getSubCategories'])->name('sub-category-list');
Route::resource('child-category', ChildCategoryController::class);

//Brand Routes
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

//Vendor Profile Routes
Route::resource('vendor-profile', AdminVendorProfileController::class);

//Product Routes
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::get('product/sub-categories-list', [ProductController::class, 'getSubCategories'])->name('product.sub-categories-list');
Route::get('product/child-categories-list', [ProductController::class, 'getChildCategories'])->name('product.child-categories-list');
Route::resource('product', ProductController::class);

//Product Image Gallery Routes
Route::resource('product-image-gallery', ProductImageGalleryController::class);

//Product Variant Routes
Route::put('product-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
Route::resource('product-variant', ProductVariantController::class);

//Product Variant Item Routes
Route::put('product-variant-item/change-status', [ProductVariantItemController::class, 'changeStatus'])->name('product-variant-item.change-status');
Route::get('product-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('product-variant-item.index');
Route::get('product-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('product-variant-item.create');
Route::post('product-variant-item', [ProductVariantItemController::class, 'store'])->name('product-variant-item.store');
Route::get('product-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('product-variant-item.edit');
Route::put('product-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('product-variant-item.update');
Route::delete('product-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('product-variant-item.destroy');

//Seller Product Routes
Route::get('seller-product', [SellerProductController::class, 'index'])->name('seller-product.index');
Route::get('seller-pending-product', [SellerProductController::class, 'indexPendingProduct'])->name('seller-pending-product.index');
Route::put('seller-pending-product/approve', [SellerProductController::class, 'changeApproveStatus'])->name('seller-pending-product.approve');

//Flash Sale Route
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
Route::put('flash-sale', [FlashSaleController::class, 'update'])->name('flash-sale.update');
Route::post('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
Route::put('flash-sale/change-status/show-at-home', [FlashSaleController::class, 'changeShowAtHomeStatus'])->name('flash-sale.change-status.show-at-home');
Route::put('flash-sale/change-status/status', [FlashSaleController::class, 'changeStatus'])->name('flash-sale.change-status.status');
Route::delete('flash-sale/{id}', [FlashSaleController::class, 'destroy'])->name('flash-sale.destroy');

//Setting Route
Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
Route::put('general-setting-update', [SettingController::class, 'updateGeneralSetting'])->name('general-setting-update');
Route::put('email-setting-update', [SettingController::class, 'emailConfigSettingUpdate'])->name('email-setting-update');

//Coupon Route
Route::put('coupon/change-status', [CouponController::class, 'changeStatus'])->name('coupon.change-status');
Route::resource('coupon', CouponController::class);

//Shipping Rule Route
Route::put('shipping-rule/change-status', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rule.change-status');
Route::resource('shipping-rule', ShippingRuleController::class);

// Payment Setting Route
Route::get('payment-setting', [PaymentSettingController::class, 'index'])->name('payment-setting.index');
Route::resource('paypal-setting', PaypalSettingController::class);
Route::put('stripe-setting/{id}', [StripeSettingController::class, 'update'])->name('stripe-setting.update');
Route::put('razorpay-setting/{id}', [RazorpaySettingController::class, 'update'])->name('razorpay-setting.update');

// Order Route
Route::get('order-status', [OrderController::class, 'changeOrderStatus'])->name('order-status');
Route::get('payment-status', [OrderController::class, 'changePaymentStatus'])->name('payment-status');

Route::get('pending-order', [OrderController::class, 'pendingOrders'])->name('pending-order');
Route::get('processed-order', [OrderController::class, 'processedOrders'])->name('processed-order');
Route::get('dropped-off-order', [OrderController::class, 'droppedOfOrders'])->name('dropped-off-order');
Route::get('shipped-order', [OrderController::class, 'shippedOrders'])->name('shipped-order');
Route::get('out-for-delivery-order', [OrderController::class, 'outForDeliveryOrders'])->name('out-for-delivery-order');
Route::get('delivered-order', [OrderController::class, 'deliveredOrders'])->name('delivered-order');
Route::get('canceled-order', [OrderController::class, 'canceledOrders'])->name('canceled-order');

Route::resource('order', OrderController::class);

// Transaction Route
Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');

// Home Page Setting Route
Route::get('home-page-setting', [HomePageSettingController::class, 'index'])->name('home-page-setting.index');
Route::put('popular-category-section', [HomePageSettingController::class, 'updatePopularCategorySection'])->name('popular-category-section');
Route::put('product-slider-section-one', [HomePageSettingController::class, 'updateProductSliderSectionOne'])->name('product-slider-section-one');
Route::put('product-slider-section-two', [HomePageSettingController::class, 'updateProductSliderSectionTwo'])->name('product-slider-section-two');
Route::put('product-slider-section-three', [HomePageSettingController::class, 'updateProductSliderSectionThree'])->name('product-slider-section-three');

// Footer Route
Route::resource('footer-info', FooterInfoController::class);
Route::put('footer-social/change-status', [FooterSocialController::class, 'changeStatus'])->name('footer-social.change-status');
Route::resource('footer-social', FooterSocialController::class);

Route::put('footer-grid-two/change-status', [FooterGridTwoController::class, 'changeStatus'])->name('footer-grid-two.change-status');
Route::put('footer-grid-two/change-title', [FooterGridTwoController::class, 'changeTitle'])->name('footer-grid-two.change-title');
Route::resource('footer-grid-two', FooterGridTwoController::class);

Route::put('footer-grid-three/change-status', [FooterGridThreeController::class, 'changeStatus'])->name('footer-grid-three.change-status');
Route::put('footer-grid-three/change-title', [FooterGridThreeController::class, 'changeTitle'])->name('footer-grid-three.change-title');
Route::resource('footer-grid-three', FooterGridThreeController::class);
