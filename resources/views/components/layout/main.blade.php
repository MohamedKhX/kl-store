<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Arkan - Store</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicons/favicon.ico">
    <link rel="manifest" href="img/favicons/manifest.json">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <meta name="msapplication-TileImage" content="img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">

    {{-- Aplaine JS --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    @livewireScripts
    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('/css/theme.css') }}" rel="stylesheet" />
    @if(isset($style))
        {{ $style }}
    @endif
</head>
<body>
    {{-- Start Navbar --}}
    <x-layout.navbar />
    {{-- End Navbar --}}

    {{-- Start Content --}}
    {{ $slot }}
    {{-- End Content --}}

    {{-- Start Footer --}}
    <x-layout.footer />
    {{-- End Footer --}}

    {{-- Start Java scirpt --}}
    <script src="{{ asset('js/@popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/is/is.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('js/feather-icons/feather.min.js') }}"></script>
    <script>
        feather.replace();
    </script>
    <script src="{{ asset('js/theme.js') }}"></script>
    {{-- End Java scirpt --}}
</body>
</html>
