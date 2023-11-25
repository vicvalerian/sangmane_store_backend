@php
    $categoryProductSliderSectionTwo = json_decode($categoryProductSliderSectionTwo->value);
    $lastKey = [];

    foreach ($categoryProductSliderSectionTwo as $key => $category) {
        if ($category == null) {
            break;
        }
        $lastKey = [$key => $category];
    }
    if (array_keys($lastKey)[0] == 'category') {
        $category = \App\Models\Category::findOrFail($lastKey['category']);
        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['product_variants', 'category', 'product_image_galleries'])
            ->where('category_id', $category->id)
            ->take(12)
            ->orderBy('id', 'desc')
            ->get();
    } elseif (array_keys($lastKey)[0] == 'sub_category') {
        $category = \App\Models\SubCategory::findOrFail($lastKey['sub_category']);
        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['product_variants', 'category', 'product_image_galleries'])
            ->where('sub_category_id', $category->id)
            ->take(12)
            ->orderBy('id', 'desc')
            ->get();
    } else {
        $category = \App\Models\ChildCategory::findOrFail($lastKey['child_category']);
        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['product_variants', 'category', 'product_image_galleries'])
            ->where('child_category_id', $category->id)
            ->take(12)
            ->orderBy('id', 'desc')
            ->get();
    }
@endphp
<section id="wsus__electronic2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{ $category->name }}</h3>
                    <a class="see_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row flash_sell_slider">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</section>
