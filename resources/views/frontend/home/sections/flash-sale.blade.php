<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{ asset('frontend/images/flash_sell_bg.jpg') }})">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">flash sale</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{ route('flash-sale') }}">see more <i
                                class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @php
                $products = \App\Models\Product::withAvg('reviews', 'rating')
                    ->withCount('reviews')
                    ->with(['product_variants', 'category', 'product_image_galleries'])
                    ->whereIn('id', $flashSaleItems)
                    ->get();
            @endphp
            @foreach ($products as $product)
                <div class="col-xl-3 col-sm-6 col-lg-4">
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
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class="show_product_modal" data-id="{{ $product->id }}"><i
                                        class="far fa-eye"></i></a>
                            </li>
                            <li><a href="#" class="add_to_wishlist" data-id="{{ $product->id }}"><i
                                        class="far fa-heart"></i></a></li>
                            {{-- <li><a href="#"><i class="far fa-random"></i></a> --}}
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">{{ $product->category->name }} </a>
                            <p class="wsus__pro_rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $product->reviews_avg_rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span>({{ $product->reviews_count }} review)</span>
                            </p>
                            <a class="wsus__pro_name"
                                href="{{ route('product-detail', $product->slug) }}">{{ $product->name }}</a>
                            @if (checkDiscount($product))
                                <p class="wsus__price">{{ $settings->currency_icon }}{{ $product->offer_price }}
                                    <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                                </p>
                            @else
                                <p class="wsus__price">{{ $settings->currency_icon }}{{ $product->price }}</p>
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
                                                    {{ $settings->currency_icon }}{{ $variantItem->price }} )
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
        </div>
    </div>
</section>

@push('scripts')
    <script>
        $(document).ready(function() {
            simplyCountdown('.simply-countdown-one', {
                year: {{ date('Y', strtotime($flashSale->end_date)) }},
                month: {{ date('m', strtotime($flashSale->end_date)) }},
                day: {{ date('d', strtotime($flashSale->end_date)) }},
            });
        })
    </script>
@endpush
