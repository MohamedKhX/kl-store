<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta property="og:title" content="{{ getStoreTitle() }}">
    <meta property="og:image" content="{{ getStoreMetaPhoto() }}">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>{{ __('home.store_name') }}</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicons/favicon-16x16.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicons/favicon.ico')}}">
    <link rel="manifest" href="{{asset(' img/favicons/manifest.json')}}">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <meta name="msapplication-TileImage" content="{{asset('img/favicons/mstile-150x150.png')}}">
    <meta name="theme-color" content="#ffffff">

    {{-- Aplaine JS --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('/css/theme.css') }}" rel="stylesheet" />
    @stack('styles')
</head>
<body>
    {{-- Start Navbar --}}
    <x-layout.navbar />
    {{-- End Navbar --}}

    {{-- Cart Model --}}
    <x-cart />
    {{-- End Cart Model --}}

    {{-- Start Content --}}
    {{ $slot }}
    {{-- End Content --}}

    {{-- Start Footer --}}
    <x-layout.footer />
    {{-- End Footer --}}

    {{-- Start Java scirpt --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    @livewireScripts

    <script>

        let thumbnail   = null;
        let smallImages = null;
        let sizeBoxes   = null;


        function load() {
            thumbnail   = document.querySelector('#thumbnail');
            smallImages = document.querySelectorAll('.sm-img');
            sizeBoxes   = document.querySelectorAll('.size-square');
        }

        function changeSize(currentBox) {
            for (const box of sizeBoxes) {
                box.classList.remove('size-square-active');
            }
            currentBox.classList.add('size-square-active')
        }

        function changeImg(img, el) {
            unActiveElements();
            el.classList.add('sm-img-active')
            thumbnail.src = img;
        }

        function unActiveElements() {
            for (const img of smallImages) {
                img.classList.remove('sm-img-active');
            }
        }

        function clearActive() {
            let colorImages = document.querySelectorAll('.color-img');
            for (const image of colorImages) {
                image.classList.remove('sm-img-active');
            }
        }

        function changeColorLink(productId, colorHash) {
            if(window.location.href.split('#')[0].includes('/product')) {
                const newUrl = `{{ url('') }}/product/${productId}/${colorHash}`;
                history.pushState({}, null, newUrl);
            }
        }
    </script>
    @stack('scripts')
</body>
</html>
