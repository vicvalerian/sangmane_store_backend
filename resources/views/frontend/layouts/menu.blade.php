@php
    $categories = \App\Models\Category::where('status', 1)
        ->with([
            'sub_categories' => function ($q) {
                $q->where('status', 1)->with([
                    'child_categories' => function ($qq) {
                        $qq->where('status', 1);
                    },
                ]);
            },
        ])
        ->get();
@endphp

<nav class="wsus__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="wsus_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>
                    <ul class="wsus_menu_cat_item show_home toggle_menu">
                        {{-- <li><a href="#"><i class="fas fa-star"></i> hot promotions</a></li> --}}

                        @foreach ($categories as $category)
                            <li><a class="{{ count($category->sub_categories) > 0 ? 'wsus__droap_arrow' : '' }}"
                                    href="{{ route('products.index', ['category' => $category->slug]) }}"><i
                                        class="{{ $category->icon }}"></i>
                                    {{ $category->name }} </a>
                                @if (count($category->sub_categories) > 0)
                                    <ul class="wsus_menu_cat_droapdown">
                                        @foreach ($category->sub_categories as $sub_category)
                                            <li><a
                                                    href="{{ route('products.index', ['sub_category' => $sub_category->slug]) }}">{{ $sub_category->name }}
                                                    <i
                                                        class="{{ count($sub_category->child_categories) > 0 ? 'fas fa-angle-right' : '' }}"></i></a>
                                                @if (count($sub_category->child_categories) > 0)
                                                    <ul class="wsus__sub_category">
                                                        @foreach ($sub_category->child_categories as $child_category)
                                                            <li><a
                                                                    href="{{ route('products.index', ['child_category' => $child_category->slug]) }}">{{ $child_category->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        {{-- <li><a href="#"><i class="fal fa-gem"></i> View All Categories</a></li> --}}
                    </ul>

                    <ul class="wsus__menu_item">
                        <li><a class="{{ setActiveSidebar(['home']) }}" href="{{ url('/') }}">home</a></li>
                        <li><a class="{{ setActiveSidebar(['vendor.index']) }}"
                                href="{{ route('vendor.index') }}">vendor</a></li>
                        <li><a class="{{ setActiveSidebar(['blog']) }}" href="{{ route('blog') }}">blog</a></li>
                        <li><a class="{{ setActiveSidebar(['flash-sale']) }}" href="{{ route('flash-sale') }}">flash
                                sale</a></li>
                        <li><a class="{{ setActiveSidebar(['about']) }}" href="{{ route('about') }}">about</a></li>
                        <li><a class="{{ setActiveSidebar(['contact']) }}" href="{{ route('contact') }}">contact</a>
                        </li>
                    </ul>
                    <ul class="wsus__menu_item wsus__menu_item_right">
                        <li><a href="{{ route('product-track.index') }}">track order</a></li>
                        @if (auth()->check())
                            @if (auth()->user()->role === 'user')
                                <li><a href="{{ route('user.dashboard') }}">my account</a></li>
                            @elseif (auth()->user()->role === 'vendor')
                                <li><a href="{{ route('vendor.dashboard') }}">Vendor Dashboard</a></li>
                            @elseif (auth()->user()->role === 'admin')
                                <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                            @endif
                        @else
                            <li><a href="{{ route('login') }}">login</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<section id="wsus__mobile_menu">
    <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
    <ul class="wsus__mobile_menu_header_icon d-inline-flex">

        <li><a href="{{ route('user.wishlist.index') }}"><i class="fal fa-heart"></i><span id="wishlist_count">
                    @if (auth()->check())
                        {{ \App\Models\Wishlist::where('user_id', auth()->user()->id)->count() }}
                    @else
                        0
                    @endif
                </span></a></li>

        {{-- <li><a href="compare.html"><i class="far fa-random"></i> </i><span>3</span></a></li> --}}
    </ul>
    <form action="{{ route('products.index') }}">
        <input type="text" placeholder="Search" name="search" value="{{ request()->search }}">
        <button type="submit"><i class="far fa-search"></i></button>
    </form>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                role="tab" aria-controls="pills-home" aria-selected="true">Categories</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                role="tab" aria-controls="pills-profile" aria-selected="false">main menu</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <ul class="wsus_mobile_menu_category">
                        @foreach ($categories as $category)
                            <li><a href="#"
                                    class="{{ count($category->sub_categories) > 0 ? 'accordion-button' : '' }} collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreew-{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="flush-collapseThreew-{{ $loop->index }}"><i
                                        class="{{ $category->icon }}"></i>
                                    {{ $category->name }}</a>
                                @if (count($category->sub_categories) > 0)
                                    <div id="flush-collapseThreew-{{ $loop->index }}"
                                        class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach ($category->sub_categories as $sub_category)
                                                    <li><a href="#">{{ $sub_category->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                        <li><a href="#"><i class="fal fa-gem"></i> View All Categories</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">shop</a>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample2">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="#">men's</a></li>
                                        <li><a href="#">wemen's</a></li>
                                        <li><a href="#">kid's</a></li>
                                        <li><a href="#">others</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><a href="vendor.html">vendor</a></li>
                        <li><a href="{{ route('blog') }}">blog</a></li>
                        <li><a href="daily_deals.html">campain</a></li>
                        <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree101" aria-expanded="false"
                                aria-controls="flush-collapseThree101">pages</a>
                            <div id="flush-collapseThree101" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample2">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="404.html">404</a></li>
                                        <li><a href="faqs.html">faq</a></li>
                                        <li><a href="invoice.html">invoice</a></li>
                                        <li><a href="about_us.html">about</a></li>
                                        <li><a href="team.html">team</a></li>
                                        <li><a href="product_grid_view.html">product grid view</a></li>
                                        <li><a href="product_grid_view.html">product list view</a></li>
                                        <li><a href="team_details.html">team details</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><a href="{{ route('product-track.index') }}">track order</a></li>
                        <li><a href="daily_deals.html">daily deals</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
