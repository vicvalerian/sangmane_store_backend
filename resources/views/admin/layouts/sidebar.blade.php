<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown  {{ setActiveSidebar(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li
                class="dropdown {{ setActiveSidebar(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Categories</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActiveSidebar(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Category</a></li>
                    <li class="{{ setActiveSidebar(['admin.sub-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.sub-category.index') }}">Sub Category</a></li>
                    <li class="{{ setActiveSidebar(['admin.child-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.child-category.index') }}">Child Category</a></li>
                </ul>
            </li>
            <li
                class="dropdown {{ setActiveSidebar([
                    'admin.order.*',
                    'admin.pending-order',
                    'admin.processed-order',
                    'admin.dropped-off-order',
                    'admin.shipped-order',
                    'admin.out-for-delivery-order',
                    'admin.delivered-order',
                    'admin.canceled-order',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActiveSidebar(['admin.order.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order.index') }}">All Order</a></li>
                    <li class="{{ setActiveSidebar(['admin.pending-order']) }}"><a class="nav-link"
                            href="{{ route('admin.pending-order') }}">Pending Order</a></li>
                    <li class="{{ setActiveSidebar(['admin.processed-order']) }}"><a class="nav-link"
                            href="{{ route('admin.processed-order') }}">Processed Order</a></li>
                    <li class="{{ setActiveSidebar(['admin.dropped-off-order']) }}"><a class="nav-link"
                            href="{{ route('admin.dropped-off-order') }}">Dropped Off Order</a></li>
                    <li class="{{ setActiveSidebar(['admin.shipped-order']) }}"><a class="nav-link"
                            href="{{ route('admin.shipped-order') }}">Shipped Order</a></li>
                    <li class="{{ setActiveSidebar(['admin.out-for-delivery-order']) }}"><a class="nav-link"
                            href="{{ route('admin.out-for-delivery-order') }}">Out For Delivery Order</a></li>
                    <li class="{{ setActiveSidebar(['admin.delivered-order']) }}"><a class="nav-link"
                            href="{{ route('admin.delivered-order') }}">Delivered Order</a></li>
                    <li class="{{ setActiveSidebar(['admin.canceled-order']) }}"><a class="nav-link"
                            href="{{ route('admin.canceled-order') }}">Canceled Order</a></li>
                </ul>
            </li>
            <li class="{{ setActiveSidebar(['admin.transaction.*']) }}"><a class="nav-link"
                    href="{{ route('admin.transaction.index') }}"><i class="far fa-square"></i>
                    <span>Transaction</span></a></li>
            <li
                class="dropdown {{ setActiveSidebar([
                    'admin.brand.*',
                    'admin.product.*',
                    'admin.product-image-gallery.*',
                    'admin.product-variant.*',
                    'admin.product-variant-item.*',
                    'admin.seller-product.index',
                    'admin.seller-pending-product.index',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Product</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActiveSidebar(['admin.brand.*']) }}"><a class="nav-link"
                            href="{{ route('admin.brand.index') }}">Brand</a></li>
                    <li
                        class="{{ setActiveSidebar([
                            'admin.product.*',
                            'admin.product-image-gallery.*',
                            'admin.product-variant.*',
                            'admin.product-variant-item.*',
                        ]) }}">
                        <a class="nav-link" href="{{ route('admin.product.index') }}">Product</a>
                    <li class="{{ setActiveSidebar(['admin.seller-product.*']) }}">
                        <a class="nav-link" href="{{ route('admin.seller-product.index') }}">Seller Product</a>
                    </li>
                    <li class="{{ setActiveSidebar(['admin.seller-pending-product.index']) }}">
                        <a class="nav-link" href="{{ route('admin.seller-pending-product.index') }}">Seller Pending
                            Product</a>
                    </li>
                </ul>
            </li>
            <li
                class="dropdown {{ setActiveSidebar(['admin.vendor-profile.*', 'admin.flash-sale.*', 'admin.coupon.*', 'admin.shipping-rule.*', 'admin.payment-setting.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActiveSidebar(['admin.flash-sale.*']) }}"><a class="nav-link"
                            href="{{ route('admin.flash-sale.index') }}">Flash Sale</a></li>
                    <li class="{{ setActiveSidebar(['admin.coupon.*']) }}"><a class="nav-link"
                            href="{{ route('admin.coupon.index') }}">Coupon</a></li>
                    <li class="{{ setActiveSidebar(['admin.shipping-rule.*']) }}"><a class="nav-link"
                            href="{{ route('admin.shipping-rule.index') }}">Shipping Rule</a></li>
                    <li class="{{ setActiveSidebar(['admin.vendor-profile.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-profile.index') }}">Vendor Profile</a></li>
                    <li class="{{ setActiveSidebar(['admin.payment-setting.*']) }}"><a class="nav-link"
                            href="{{ route('admin.payment-setting.index') }}">Payment Setting</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setActiveSidebar(['admin.slider.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Manage Website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActiveSidebar(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Slider</a></li>
                    <li class="{{ setActiveSidebar(['admin.home-page-setting.*']) }}"><a class="nav-link"
                            href="{{ route('admin.home-page-setting.index') }}">Home Page Setting</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setActiveSidebar(['admin.footer-info.index', 'admin.footer-social.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Footer</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActiveSidebar(['admin.footer-info.index']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-info.index') }}">Footer Info</a></li>
                    <li class="{{ setActiveSidebar(['admin.footer-social.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-social.index') }}">Footer Social</a></li>
                </ul>
            </li>
            <li class="{{ setActiveSidebar(['admin.setting.*']) }}"><a class="nav-link"
                    href="{{ route('admin.setting.index') }}"><i class="far fa-square"></i>
                    <span>Settings</span></a></li>
            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li> --}}
            {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}
        </ul>
    </aside>
</div>
