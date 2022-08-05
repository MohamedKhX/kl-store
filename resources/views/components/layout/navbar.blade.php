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
                <li class="nav-item px-2" x-data="{show: false}">
                    <a @click="show = ! show" class="fw-medium" style="cursor: pointer; padding: .5rem 0; display: block" aria-current="page">
                        @if(ar())
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        @endif

                        {{ __('elements.language') }}

                        @if(!ar())
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        @endif
                    </a>
                    <div style="display: none" x-show="show" x-transition>
                        <a href="{{ route('language-switcher', 'en') }}">English</a>
                        <span>-</span>
                        <a href="{{ route('language-switcher', 'ar') }}">العربية</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="d-flex d-none d-lg-flex" style="">
            <x-layout.navbar.icons />
        </div>
    </div>
</nav>
