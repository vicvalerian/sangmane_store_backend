@php
    $categoryProductSliderSectionThree = json_decode($categoryProductSliderSectionThree->value, true);
@endphp
<section id="wsus__weekly_best" class="home2_wsus__weekly_best_2 ">
    <div class="container">
        <div class="row">
            @foreach ($categoryProductSliderSectionThree as $slider)
                @php
                    $lastKey = [];

                    foreach ($slider as $key => $category) {
                        if ($category == null) {
                            break;
                        }
                        $lastKey = [$key => $category];
                    }

                    if (array_keys($lastKey)[0] == 'category') {
                        $category = \App\Models\Category::findOrFail($lastKey['category']);
                        $products = \App\Models\Product::withAvg('reviews', 'rating')
                            ->withCount('reviews')
                            ->where('category_id', $category->id)
                            ->take(6)
                            ->where(['status' => 1, 'is_approved' => 1])
                            ->orderBy('id', 'desc')
                            ->get();
                    } elseif (array_keys($lastKey)[0] == 'sub_category') {
                        $category = \App\Models\SubCategory::findOrFail($lastKey['sub_category']);
                        $products = \App\Models\Product::withAvg('reviews', 'rating')
                            ->withCount('reviews')
                            ->where('sub_category_id', $category->id)
                            ->take(6)
                            ->where(['status' => 1, 'is_approved' => 1])
                            ->orderBy('id', 'desc')
                            ->get();
                    } else {
                        $category = \App\Models\ChildCategory::findOrFail($lastKey['child_category']);
                        $products = \App\Models\Product::withAvg('reviews', 'rating')
                            ->withCount('reviews')
                            ->where('child_category_id', $category->id)
                            ->take(6)
                            ->where(['status' => 1, 'is_approved' => 1])
                            ->orderBy('id', 'desc')
                            ->get();
                    }
                @endphp
                <div class="col-xl-6 col-sm-6">
                    <div class="wsus__section_header">
                        <h3>{{ $category->name }}</h3>
                    </div>
                    <div class="row weekly_best2">
                        @foreach ($products as $item)
                            <div class="col-xl-4 col-lg-4">
                                <a class="wsus__hot_deals__single" href="{{ route('product-detail', $item->slug) }}">
                                    <div class="wsus__hot_deals__single_img">
                                        <img src="{{ asset($item->thumb_image) }}" alt="product"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__hot_deals__single_text">
                                        <h5>{!! limitText($item->name) !!}</h5>
                                        <p class="wsus__rating">
                                            @php
                                                $averageRating = $item->reviews_avg_rating;
                                                $fullStars = floor($averageRating);
                                                $emptyStars = 5 - $fullStars;
                                                $hasHalfStar = $averageRating - $fullStars >= 0.5;
                                            @endphp
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                            <!-- Half Star -->
                                            @if ($hasHalfStar)
                                                <i class="fas fa-star-half-alt"></i>
                                                @php $emptyStars--; @endphp
                                            @endif
                                            <!-- Empty Stars -->
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <i class="far fa-star"></i>
                                            @endfor
                                            <span>({{ $item->reviews_count }} review)</span>
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
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
