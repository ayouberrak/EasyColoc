<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyColoc') }} - Authentification</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/css/auth.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-slate-50">
    <div class="flex min-h-screen">
        <!-- Left Side: Visual/Branding (Hidden on mobile) -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-blue-600">
            <div class="absolute inset-0 z-0 opacity-20">
                <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"></path>
                </svg>
            </div>
            
            <div class="relative z-10 w-full flex flex-col items-center justify-center p-12 text-white">
                <div class="mb-8 scale-150">
                    <x-application-logo class="w-24 h-24 fill-current" />
                </div>
                <h1 class="text-5xl font-bold mb-4 text-center">EasyColoc</h1>
                <p class="text-xl text-blue-100 text-center max-w-md">
                    Gérez votre colocation en toute simplicité. Dépenses, tâches et communication, le tout au même endroit.
                </p>
                
                <div class="mt-12 grid grid-cols-2 gap-4 w-full max-w-sm">
                    <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20">
                        <div class="text-2xl font-bold mb-1">10k+</div>
                        <div class="text-sm text-blue-100">Colocataires</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20">
                        <div class="text-2xl font-bold mb-1">98%</div>
                        <div class="text-sm text-blue-100">Satisfaction</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Auth Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 animate-fade-in">
            <div class="w-full max-w-md">
                <div class="mb-8 lg:hidden text-center">
                    <x-application-logo class="w-12 h-12 mx-auto mb-4 text-blue-600 fill-current" />
                    <h2 class="text-2xl font-bold text-slate-800">EasyColoc</h2>
                </div>

                <div class="auth-glass p-8 sm:p-10 rounded-3xl">
                    {{ $slot }}
                </div>
                
                <p class="mt-8 text-center text-sm text-slate-500">
                    &copy; {{ date('Y') }} EasyColoc. Tous droits réservés.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
