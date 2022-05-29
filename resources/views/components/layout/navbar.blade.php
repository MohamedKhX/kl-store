<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container">
        <a class="navbar-brand d-inline-flex" href="{{ route('home') }}">
            <img class="d-inline-block" src="{{ asset('img/gallery/logo.png') }}" alt="logo" />
            <span class="text-1000 fs-0 fw-bold ms-2">{{ getSiteName() }}</span>
        </a>
        <div class="d-flex d-lg-none">
            <div class="d-flex me-1" style="margin-top: 6px">
                <x-layout.navbar.icons />
            </div>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        </div>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item px-2">
                    <a class="nav-link fw-medium active" aria-current="page" href="{{ route('home') }}">
                        Home
                    </a>
                </li>  <li class="nav-item px-2">
                    <a class="nav-link fw-medium" aria-current="page" href="#categories">
                        Categories
                    </a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link fw-medium" href="{{ route('faqs') }}">
                        FAQS
                    </a>
                </li>
            </ul>
        </div>
        <div class="d-flex d-none d-lg-flex" style="">
            <x-layout.navbar.icons />
        </div>
    </div>
</nav>
