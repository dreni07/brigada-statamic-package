<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('cms-starter::partials.seo-meta')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-white text-gray-900 antialiased">
    @include('cms-starter::partials.nav')

    <main class="flex-1">
        @yield('content')
    </main>

    @include('cms-starter::partials.footer')
</body>
</html>
