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
            @foreach ($flashSaleItems as $item)
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">{{ productType($item->product->product_type) }}</span>
                        @if (checkDiscount($item->product))
                            <span
                                class="wsus__minus">-{{ calculateDiscountPercentage($item->product->price, $item->product->offer_price) }}%</span>
                        @endif
                        <a class="wsus__pro_link" href="{{ route('product-detail', $item->product->slug) }}">
                            <img src="{{ asset($item->product->thumb_image) }}" alt="product"
                                class="img-fluid w-100 img_1" />
                            <img src="
                                @if (isset($item->product->product_image_galleries[0]->image)) {{ asset($item->product->product_image_galleries[0]->image) }}
                                @else
                                    {{ asset($item->product->thumb_image) }} @endif
                                "
                                alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">{{ $item->product->category->name }} </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(133 review)</span>
                            </p>
                            <a class="wsus__pro_name"
                                href="{{ route('product-detail', $item->product->slug) }}">{{ $item->product->name }}</a>
                            @if (checkDiscount($item->product))
                                <p class="wsus__price">${{ $item->product->offer_price }}
                                    <del>${{ $item->product->price }}</del>
                                </p>
                            @else
                                <p class="wsus__price">${{ $item->product->price }}</p>
                            @endif
                            <a class="add_cart" href="#">add to cart</a>
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
                enableUtc: true
            });
        })
    </script>
@endpush
