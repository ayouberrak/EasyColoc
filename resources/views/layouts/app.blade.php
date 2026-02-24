<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EasyColoc') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-sans antialiased text-slate-900 selection:bg-blue-100 selection:text-blue-900">
        <div class="min-h-screen bg-[#f8fafc] relative overflow-x-hidden">
            <!-- Background Decoration -->
            <div class="absolute top-0 right-0 -z-0 w-[500px] h-[500px] bg-blue-50/50 rounded-full blur-[120px] -mr-48 -mt-48 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 -z-0 w-[500px] h-[500px] bg-indigo-50/50 rounded-full blur-[120px] -ml-48 -mb-48 pointer-events-none"></div>

            @include('layouts.navigation')

            <div class="relative z-10">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white/50 backdrop-blur-md border-b border-slate-100 sticky top-0 z-40">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <h2 class="font-heading font-black text-2xl text-slate-900 leading-tight">
                                {{ $header }}
                            </h2>
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="animate-fade-in">
                    {{ $slot }}
                </main>
            </div>
            
            @stack('modals')
            @stack('scripts')
        </div>
    </body>
</html>

