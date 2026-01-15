<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Crop Rotation</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ url('/build/assets/app-fNCE5DMw.css') }}">
    <script src="{{ url('/build/assets/app-z-Rg4TxU.js') }}" defer></script>




    @yield('styles')
</head>

<body>

    <header class="bg-blue-500 text-white">
        <div class="max-w-5xl mx-auto flex items-center justify-between px-6 py-4">
            <h1 class="text-2xl font-bold">
                Crop Rotation
            </h1>

            <nav class="flex gap-4 text-sm font-medium">
                <a href="{{ route('index') }}" class="hover:underline">Home</a>
                <a href="{{ route('map') }}" class="hover:underline">Map</a>

                @auth
                    <a href="{{ route('profile') }}" class="hover:underline">Profile</a>
                    <a href="{{ route('logout') }}" class="hover:underline">Log out</a>
                @else
                    <a href="{{ route('register') }}" class="hover:underline">Sign up</a>
                    <a href="{{ route('login') }}" class="hover:underline">Log in</a>
                @endauth

                <a href="{{ route('create') }}" class="bg-white text-blue-500 px-3 py-1 rounded hover:bg-gray-100">
                    Create Article
                </a>
            </nav>
        </div>
    </header>

    <main class="content max-w-5xl mx-auto px-6 py-8">
        @yield('content')
    </main>

</body>

</html>