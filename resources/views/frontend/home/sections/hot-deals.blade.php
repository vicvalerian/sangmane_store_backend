<section id="wsus__hot_deals" class="wsus__hot_deals_2">
    <div class="container">
        <div class="wsus__hot_large_item">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header justify-content-start">
                        <div class="monthly_top_filter2 mb-1">
                            <button class="active auto_click" data-filter=".new_arrival">new arrival</button>
                            <button data-filter=".featured_product">featured</button>
                            <button data-filter=".top_product">top product</button>
                            <button data-filter=".best_product">best product</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row grid2">
                @foreach ($typeBaseProducts as $key => $products)
                    @foreach ($products as $product)
                        <div class="col-xl-3 col-sm-6 col-lg-4 {{ $key }}">
                            <div class="wsus__product_item">
                                <span class="wsus__new">{{ productType($product->product_type) }}</span>
                                @if (checkDiscount($product))
                                    <span
                                        class="wsus__minus">-{{ calculateDiscountPercentage($product->price, $product->offer_price) }}%</span>
                                @endif
                                <a class="wsus__pro_link" href="{{ route('product-detail', $product->slug) }}">
                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                        class="img-fluid w-100 img_1" />
                                    <img src="
                                    @if (isset($product->product_image_galleries[0]->image)) {{ asset($product->product_image_galleries[0]->image) }}
                                    @else
                                        {{ asset($product->thumb_image) }} @endif
                                    "
                                        alt="product" class="img-fluid w-100 img_2" />
                                </a>
                                <ul class="wsus__single_pro_icon">
                                    <li><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $product->id }}"><i
                                                class="far fa-eye"></i></a>
                                    </li>
                                    <li><a href="#" class="add_to_wishlist" data-id="{{ $product->id }}"><i
                                                class="far fa-heart"></i></a></li>
                                    {{-- <li><a href="#"><i class="far fa-random"></i></a> --}}
                                </ul>
                                <div class="wsus__product_details">
                                    <a class="wsus__category" href="#">{{ $product->category->name }}
                                    </a>
                                    <p class="wsus__pro_rating">
                                        @php
                                            $avgRating = $product->reviews()->avg('rating');
                                            $fullRating = round($avgRating);
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $fullRating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        <span>({{ count($product->reviews) }} review)</span>
                                    </p>
                                    <a class="wsus__pro_name"
                                        href="{{ route('product-detail', $product->slug) }}">{{ $product->name }}</a>
                                    @if (checkDiscount($product))
                                        <p class="wsus__price">
                                            {{ $settings->currency_icon }}{{ $product->offer_price }}
                                            <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                                        </p>
                                    @else
                                        <p class="wsus__price">
                                            {{ $settings->currency_icon }}{{ $product->price }}</p>
                                    @endif
                                    <form class="shopping-cart-form">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        @foreach ($product->product_variants as $variant)
                                            @if ($variant->status != 0)
                                                <select class="d-none" name="variant_items[]">
                                                    @foreach ($variant->product_variant_items as $variantItem)
                                                        @if ($variantItem->status != 0)
                                                        @endif
                                                        <option value="{{ $variantItem->id }}"
                                                            {{ $variantItem->is_default == 1 ? 'selected' : '' }}>
                                                            {{ $variantItem->name }} (
                                                            {{ $settings->currency_icon }}{{ $variantItem->price }}
                                                            )
                                                        </option>
                                                    @endforeach
                                                    <input type="hidden" min="1" max="100" name="qty"
                                                        value="1" />
                                                </select>
                                            @endif
                                        @endforeach
                                        <button type="submit" class="add_cart">add to cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach

            </div>
        </div>

        <section id="wsus__single_banner" class="home_2_single_banner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        @if ($homepage_section_banner_three->banner_one->status == 1)
                            <div class="wsus__single_banner_content banner_1">
                                <div class="wsus__single_banner_img">
                                    <img src="{{ asset($homepage_section_banner_three->banner_one->banner_image) }}"
                                        alt="banner" class="img-fluid w-100">
                                </div>
                                <div class="wsus__single_banner_text">
                                    <h6>sell on <span>35% off</span></h6>
                                    <h3>smart watch</h3>
                                    <a class="shop_btn"
                                        href="{{ asset($homepage_section_banner_three->banner_one->banner_url) }}">shop
                                        now</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                @if ($homepage_section_banner_three->banner_two->status == 1)
                                    <div class="wsus__single_banner_content single_banner_2">
                                        <div class="wsus__single_banner_img">
                                            <img src="{{ asset($homepage_section_banner_three->banner_two->banner_image) }}"
                                                alt="banner" class="img-fluid w-100">
                                        </div>
                                        <div class="wsus__single_banner_text">
                                            <h6>New Collection</h6>
                                            <h3>kid's fashion</h3>
                                            <a class="shop_btn"
                                                href="{{ asset($homepage_section_banner_three->banner_two->banner_url) }}">shop
                                                now</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12 mt-lg-4">
                                @if ($homepage_section_banner_three->banner_three->status == 1)
                                    <div class="wsus__single_banner_content">
                                        <div class="wsus__single_banner_img">
                                            <img src="{{ asset($homepage_section_banner_three->banner_three->banner_image) }}"
                                                alt="banner" class="img-fluid w-100">
                                        </div>
                                        <div class="wsus__single_banner_text">
                                            <h6>sell on <span>42% off</span></h6>
                                            <h3>winter collection</h3>
                                            <a class="shop_btn"
                                                href="{{ $homepage_section_banner_three->banner_three->banner_url }}">shop
                                                now</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
