<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function dashboard()
    {
        $todaysOrder = Order::whereDate('created_at', Carbon::today())->whereHas('order_products', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $todaysPendingOrder = Order::whereDate('created_at', Carbon::today())
            ->where('order_status', 'pending')
            ->whereHas('order_products', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->count();

        $totalOrder = Order::whereHas('order_products', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalPendingOrder = Order::where('order_status', 'pending')
            ->whereHas('order_products', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->count();

        $totalCompleteOrder = Order::where('order_status', 'delivered')
            ->whereHas('order_products', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->count();

        $totalProducts = Product::where('vendor_id', Auth::user()->vendor->id)->count();

        $todaysEarnings = Order::where('order_status', 'delivered')
            ->where('payment_status', 1)
            ->whereDate('created_at', Carbon::today())
            ->whereHas('order_products', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->sum('sub_total');

        $monthEarnings = Order::where('order_status', 'delivered')
            ->where('payment_status', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereHas('order_products', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->sum('sub_total');

        $yearEarnings = Order::where('order_status', 'delivered')
            ->where('payment_status', 1)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereHas('order_products', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->sum('sub_total');

        $toalEarnings = Order::where('order_status', 'delivered')
            ->whereHas('order_products', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            })->sum('sub_total');

        $totalReviews = ProductReview::whereHas('product', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        return view('vendor.dashboard.dashboard', compact(
            'todaysOrder',
            'todaysPendingOrder',
            'totalOrder',
            'totalPendingOrder',
            'totalCompleteOrder',
            'totalProducts',
            'todaysEarnings',
            'monthEarnings',
            'yearEarnings',
            'toalEarnings',
            'totalReviews',
        ));
    }
}
