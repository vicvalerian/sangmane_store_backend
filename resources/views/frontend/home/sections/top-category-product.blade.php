@php
    $popularCategories = json_decode($popularCategory->value, true);
@endphp

<section id="wsus__monthly_top" class="wsus__monthly_top_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                @if ($homepage_section_banner_one->banner_one->status == 1)
                    <div class="wsus__monthly_top_banner">
                        <div class="wsus__monthly_top_banner_img">
                            <img src="{{ asset($homepage_section_banner_one->banner_one->banner_image) }}" alt="img"
                                class="img-fluid w-100">
                            <span></span>
                        </div>
                        <div class="wsus__monthly_top_banner_text">
                            <h4>Black Friday Sale</h4>
                            <h3>Up To <span>70% Off</span></h3>
                            <H6>Everything</H6>
                            <a class="shop_btn" href="{{ $homepage_section_banner_one->banner_one->banner_url }}">shop
                                now</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header for_md">
                    <h3>Popular Categories</h3>
                    <div class="monthly_top_filter">
                        @php
                            $products = [];
                        @endphp
                        @foreach ($popularCategories as $popularCategory)
                            @php
                                $lastKey = [];
                                foreach ($popularCategory as $key => $category) {
                                    if ($category == null) {
                                        break;
                                    }
                                    $lastKey = [$key => $category];
                                }
                                if (array_keys($lastKey)[0] == 'category') {
                                    $categoryModel = \App\Models\Category::findOrFail($lastKey['category']);
                                    $products[] = \App\Models\Product::where('category_id', $categoryModel->id)
                                        ->take(12)
                                        ->orderBy('id', 'desc')
                                        ->get();
                                } elseif (array_keys($lastKey)[0] == 'sub_category') {
                                    $categoryModel = \App\Models\SubCategory::findOrFail($lastKey['sub_category']);
                                    $products[] = \App\Models\Product::where('sub_category_id', $categoryModel->id)
                                        ->take(12)
                                        ->orderBy('id', 'desc')
                                        ->get();
                                } else {
                                    $categoryModel = \App\Models\ChildCategory::findOrFail($lastKey['child_category']);
                                    $products[] = \App\Models\Product::where('child_category_id', $categoryModel->id)
                                        ->take(12)
                                        ->orderBy('id', 'desc')
                                        ->get();
                                }
                            @endphp
                            <button class="{{ $loop->index == 0 ? 'auto_click active' : '' }}"
                                data-filter=".category-{{ $loop->index }}">{{ $categoryModel->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="row grid">
                    @foreach ($products as $key => $product)
                        @foreach ($product as $item)
                            <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3 category-{{ $key }}">
                                <a class="wsus__hot_deals__single" href="{{ route('product-detail', $item->slug) }}">
                                    <div class="wsus__hot_deals__single_img">
                                        <img src="{{ asset($item->thumb_image) }}" alt="product"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__hot_deals__single_text">
                                        <h5>{!! limitText($item->name) !!}</h5>
                                        <p class="wsus__rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </p>
                                        @if (checkDiscount($item))
                                            <p class="wsus__tk">{{ $settings->currency_icon }}{{ $item->price }}
                                                <del>{{ $settings->currency_icon }}{{ $item->offer_price }}</del>
                                            </p>
                                        @else
                                            <p class="wsus__tk">{{ $settings->currency_icon }}{{ $item->price }}</p>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
