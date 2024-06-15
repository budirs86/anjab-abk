<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Anjab-ABK | {{ $title }}</title>
    
    {{-- add a custom icon  --}}
    <link rel="icon" href="{{ asset('assets/undip-logo.png') }}" type="image/png" />
    {{-- Bootstrap CDN --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    />

    {{-- Custom Styles --}}
    <link rel="stylesheet" href="/css/nav.css" />

    {{-- Feathericons CDN --}}
    <script src="https://unpkg.com/feather-icons"></script>

    {{-- JQuery CDN --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    {{-- OrgChart JS --}}
    <script src="/js/orgchart.js"></script>
</head>
<body>
    @if (Request::is('login'))
        @include('login.partials.navbar')
    @else
        @include('partials.navbar')
    @endif
    @yield('container')

    {{-- bootstrap js --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>
    <script src="bootstrap-autocomplete.min.js"></script>

    {{-- feathericons js --}}
    <script>feather.replace();</script>
</body>

    
</html>
