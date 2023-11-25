<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{ route('vendor.dashboard') }}" class="dash_logo"><img src="{{ asset($logoSetting->favicon) }}" alt="logo"
            class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="{{ setActiveSidebar(['vendor.dashboard']) }}" href="{{ route('vendor.dashboard') }}"><i
                    class="fas fa-tachometer"></i>Dashboard</a></li>
        <li><a class="" href="{{ route('home') }}"><i class="fas fa-home"></i>Go To Home</a></li>
        <li><a class="{{ setActiveSidebar(['vendor.order.*']) }}" href="{{ route('vendor.order.index') }}"><i
                    class="fas fa-box"></i> Order</a></li>
        <li><a class="{{ setActiveSidebar([
            'vendor.product.*',
            'vendor.product-image-gallery.*',
            'vendor.product-variant.*',
            'vendor.product-variant-item.*',
        ]) }}"
                href="{{ route('vendor.product.index') }}"><i class="fas fa-cart-plus"></i> Product</a></li>
        <li><a class="{{ setActiveSidebar(['vendor.review.*']) }}" href="{{ route('vendor.review.index') }}"><i
                    class="far fa-star"></i> Review</a></li>
        <li><a class="{{ setActiveSidebar(['vendor.withdraw.*']) }}" href="{{ route('vendor.withdraw.index') }}"><i
                    class="far fa-star"></i> Withdraw</a></li>
        <li><a class="{{ setActiveSidebar(['vendor.shop-profile.index']) }}"
                href="{{ route('vendor.shop-profile.index') }}"><i class="far fa-user"></i> Shop Profile</a></li>
        <li><a class="{{ setActiveSidebar(['vendor.profile']) }}" href="{{ route('vendor.profile') }}"><i
                    class="far fa-user"></i> My Profile</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                this.closest('form').submit();"><i
                        class="far fa-sign-out-alt"></i> Log out</a>
            </form>
        </li>
    </ul>
</div>
