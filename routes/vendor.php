<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use Illuminate\Support\Facades\Route;

//Vendor Routes
Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

//Vendor Shop Profile Routes
Route::resource('shop-profile', VendorShopProfileController::class);

//Product Routes
Route::get('product/sub-categories-list', [VendorProductController::class, 'getSubCategories'])->name('product.sub-categories-list');
Route::get('product/child-categories-list', [VendorProductController::class, 'getChildCategories'])->name('product.child-categories-list');
Route::resource('product', VendorProductController::class);

//Product Image Gallery Routes
Route::resource('product-image-gallery', VendorProductImageGalleryController::class);

//Product Variant Routes
Route::put('product-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
Route::resource('product-variant', VendorProductVariantController::class);
