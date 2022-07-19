<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container">


            <div class="d-flex d-lg-none me-1" style="margin-top: 6px">
                <x-layout.navbar.icons />
            </div>
            <a class="navbar-brand d-inline-flex" href="{{ route('home') }}">
                <img width="35" class="d-inline-block" src="{{ url(getStoreIcon()) }}" />
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>



        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0  {{ arRight() }}">
                <li class="nav-item px-2">
                    <a class="nav-link fw-medium active " aria-current="page" href="{{ route('home') }}">
                       {{ __('navbar.home') }}

                    </a>
                </li>
                @if(request()->routeIs('home'))
                    <li class="nav-item px-2">
                        <a class="nav-link fw-medium" aria-current="page" href="#categories">
                            {{ __('navbar.categories') }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="d-flex d-none d-lg-flex" style="">
            <x-layout.navbar.icons />
        </div>
    </div>
</nav>
