<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3  bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header d-flex text-center justify-content-center align-items-center">
        <a class="navbar-brand m-0"  href="{{ route('home') }}" target="_blank">
            <h5 class="ms-1 font-weight-bold text-white">Arkan Dashboard</h5>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto h-100  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active bg-gradient-primary' : '' }}" href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('dashboard-settings') ? 'active bg-gradient-primary' : '' }}" href="{{ route('dashboard-settings') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">settings</i>
                    </div>
                    <span class="nav-link-text ms-1">Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('admin.products.index') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.products.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('admin.collections.index') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.collections.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">collections</i>
                    </div>
                    <span class="nav-link-text ms-1">Collections</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('admin.categories.index') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.categories.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">category</i>
                    </div>
                    <span class="nav-link-text ms-1">Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('admin.orders.index') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.orders.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Orders</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('home') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>
                    <span class="nav-link-text ms-1">Return to store</span>
                </a>
            </li>
            {{--<li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('dashboard-profile') ? 'active bg-gradient-primary' : '' }}" href="{{ route('dashboard-profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">My Profile</span>
                </a>
            </li>--}}
       {{--     <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('dashboard-accounts') ? 'active bg-gradient-primary' : '' }}" href="{{ route('dashboard-accounts') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">All Accounts</span>
                </a>
            </li>--}}
            <li class="nav-item">
                <a style="cursor: pointer" class="nav-link text-white"  onclick="logout()">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">logout</i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
                <form id="logOutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <input hidden class="nav-link-text ms-1" type="submit" value="Logout">
                </form>
            </li>
        </ul>
    </div>
</aside>


@push('scripts')
    <script>
        function logout() {
            const form = document.getElementById('logOutForm');
            form.submit();
        }
    </script>
@endpush
