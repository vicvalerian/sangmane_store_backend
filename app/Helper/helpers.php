<?php

// Set sidebar item active
function setActiveSidebar(array $route)
{
    if (is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return 'active';
            }
        }
    }
}

// Check if product have discount
function checkDiscount($product)
{
    $currentDate = date('Y-m-d');

    if ($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
        return true;
    }

    return false;
}

// Calculate discount percentage
function calculateDiscountPercentage($price, $discPrice)
{
    $dicsountAmount = $price - $discPrice;
    $discountPercent = ($dicsountAmount / $price) * 100;

    return intval($discountPercent);
}

// Check product type
function productType(string $type): string
{
    switch ($type) {
        case 'new_arrival':
            return "New";
            break;
        case 'featured_product':
            return "Featured";
            break;
        case 'top_product':
            return "Top";
            break;
        case 'best_product':
            return "Best";
            break;

        default:
            return "";
            break;
    }
}

// get total cart amount
function getCartTotal()
{
    $total = 0;

    foreach (\Cart::content() as $product) {
        $total += ($product->price + $product->options->variants_total) * $product->qty;
    }

    return $total;
}
