<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>Menu App</title>

        {{-- Font Awesome 5 --}}
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        {{-- Vendor Styles (ie. Bootstrap 4, etc...) --}}
        <link rel="stylesheet" href="{{ mix('css/vendor.css') }}">
        {{-- Custom Styles --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        @yield('body')

        {{-- Global Scripts (ie. jQuery, Vue, etc...) --}}
        <script src="{{ mix('js/app.js') }}"></script>
        @yield('jsEmbed')
    </body>
</html>