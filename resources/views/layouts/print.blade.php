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
    <div class="container">
        @yield('content')

        <div id="print" class="text-center">
            <button onclick="handlePrint()" class="btn btn-info text-white">
                <i class="fa fa-print"></i>
            </button>
            <button onclick="window.history.back()" class="btn btn-danger">
                <i class="fa fa-arrow-left"></i>
            </button>
        </div>
    </div>

    <script>
        const handlePrint = () => {
            document.getElementById('print').classList.add('d-none')
            window.print()
            document.getElementById('print').classList.remove('d-none')
        }
    </script>
</body>

</html>
