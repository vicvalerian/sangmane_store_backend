<div class="modal-body">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>
    <div class="row">
        <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
            <div class="wsus__quick_view_img">
                <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                    href="{{ $product->video_link }}">
                    <i class="fas fa-play"></i>
                </a>

                <div class="row modal_slider">
                    <div class="col-xl-12">
                        <div class="modal_slider_img">
                            <img class="img-fluid w-100" src="{{ asset($product->thumb_image) }}" alt="product">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="wsus__pro_details_text">
                <a class="title" href="#">{{ $product->name }}</a>
                @if ($product->qty > 0)
                    <p class="wsus__stock_area"><span class="in_stock">in stock</span> ({{ $product->qty }}
                        item)</p>
                @elseif($product->qty == 0)
                    <p class="wsus__stock_area"><span class="in_stock">out of stock</span> ({{ $product->qty }}
                        item)</p>
                @endif
                @if (checkDiscount($product))
                    <h4>{{ $settings->currency_icon }}{{ $product->offer_price }}
                        <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                    </h4>
                @else
                    <h4>{{ $settings->currency_icon }}{{ $product->price }}</h4>
                @endif
                <p class="review">
                    @php
                        $averageRating = $product->reviews()->avg('rating');
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
                    <span>({{ count($product->reviews) }} review)</span>
                </p>
                <p class="description">{!! $product->short_description !!}</p>

                <form action="" class="shopping-cart-form">
                    <div class="wsus__selectbox">
                        <div class="row">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            @foreach ($product->product_variants as $variant)
                                @if ($variant->status != 0)
                                    <div class="col-xl-6 col-sm-6">
                                        <h5 class="mb-2">{{ $variant->name }}:</h5>
                                        <select class="select_2" name="variant_items[]">
                                            @foreach ($variant->product_variant_items as $variantItem)
                                                @if ($variantItem->status != 0)
                                                    <option value="{{ $variantItem->id }}"
                                                        {{ $variantItem->is_default == 1 ? 'selected' : '' }}>
                                                        {{ $variantItem->name }} (
                                                        {{ $settings->currency_icon }}{{ $variantItem->price }}
                                                        )
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="wsus__quentity">
                        <h5>quantity :</h5>
                        <div class="select_number">
                            <span class="spinner">
                                <span class="sub product-modal-decrement">-</span>
                                <input class="number_area product-qty" type="text" min="1" max="100"
                                    name="qty" value="1">
                                <span class="add product-modal-increment">+</span>
                            </span>
                        </div>
                    </div>
                    <ul class="wsus__button_area">
                        <li><button type="submit" class="add_cart" href="#">add to
                                cart</button></li>
                        <li><a style="border: 1px solid gray;
                            padding: 7px 11px;
                            border-radius: 100%;"
                                href="#" class="add_to_wishlist" data-id="{{ $product->id }}"><i
                                    class="fal fa-heart"></i></a></li>
                    </ul>
                </form>
                <p class="brand_model"><span>brand :</span> {{ $product->brand->name }}</p>
            </div>
        </div>
    </div>
</div>
