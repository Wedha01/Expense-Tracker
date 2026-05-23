<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Expense Tracker') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-950 text-white min-h-screen">

    <div class="min-h-screen flex items-center justify-center p-6 bg-gradient-to-br from-gray-950 via-red-950 to-black">
        
        <div class="w-full max-w-md">
            
            <!-- Logo -->
            <div class="text-center mb-10">
                <div class="flex justify-center mb-4">
                    <span class="text-6xl"></span>
                </div>
                <h1 class="text-4xl font-bold tracking-tight">Expense Tracker</h1>
                <p class="text-white/70 mt-2">Personal Finance Manager</p>
            </div>

            <!-- Main Content -->
            <div class="bg-white/10 backdrop-blur-2xl border border-white/10 shadow-2xl rounded-3xl p-8">
                @yield('content')
            </div>

            <!-- Footer -->
            <div class="text-center mt-8 text-white/50 text-sm">
                Personal Expense Tracker
            </div>
        </div>
    </div>

</body>
</html>