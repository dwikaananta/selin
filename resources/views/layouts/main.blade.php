<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.nav')

    <div class="container @auth py-5 @endauth">
        @yield('content')
    </div>

    <div class="py-2 text-center fixed-bottom bg-primary text-white">
        {{ env('APP_NAME') }}
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.2/axios.min.js"
        integrity="sha512-bHeT+z+n8rh9CKrSrbyfbINxu7gsBmSHlDCb3gUF1BjmjDzKhoKspyB71k0CIRBSjE5IVQiMMVBgCWjF60qsvA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="/js.js"></script>

    <script>
        @if (session('success'))
            alert("{{ session('success') }}")
        @endif
    </script>

    @yield('js')
</body>

</html>
