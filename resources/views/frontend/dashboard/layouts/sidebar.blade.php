<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{ route('user.dashboard') }}" class="dash_logo"><img src="{{ asset('frontend/images/logo_uservendor.png') }}" alt="logo"
            class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="{{ setActiveSidebar(['user.dashboard']) }}" href="{{ route('user.dashboard') }}"><i
                    class="fas fa-tachometer"></i>Dashboard</a></li>
        <li><a class="{{ setActiveSidebar(['/']) }}" href="{{ url('/') }}"><i class="fas fa-home"></i>Go To
                Home</a></li>
        @if (auth()->user()->role === 'vendor')
            <li><a class="{{ setActiveSidebar(['vendor.dashboard']) }}" href="{{ route('vendor.dashboard') }}"><i
                        class="fas fa-tachometer"></i>Vendor Dashboard</a></li>
        @endif
        <li><a class="{{ setActiveSidebar(['user.order.*']) }}" href="{{ route('user.order.index') }}"><i
                    class="fas fa-list-ul"></i> Orders</a></li>
        <li><a class="{{ setActiveSidebar(['user.review.*']) }}" href="{{ route('user.review.index') }}"><i
                    class="far fa-star"></i> Reviews</a></li>
        <li><a class="{{ setActiveSidebar(['user.profile']) }}" href="{{ route('user.profile') }}"><i
                    class="far fa-user"></i> My Profile</a></li>
        @if (auth()->user()->role !== 'vendor')
            <li><a class="{{ setActiveSidebar(['user.vendor-request.*']) }}"
                    href="{{ route('user.vendor-request.index') }}"><i class="far fa-user"></i> Vendor Request</a>
            </li>
        @endif
        <li><a class="{{ setActiveSidebar(['user.address.*']) }}" href="{{ route('user.address.index') }}"><i
                    class="fal fa-gift-card"></i> Addresses</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="{{ setActiveSidebar(['logout']) }}" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                this.closest('form').submit();"><i
                        class="far fa-sign-out-alt"></i> Log out</a>
            </form>
        </li>
    </ul>
</div>
