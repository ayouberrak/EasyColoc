<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EasyColoc - La gestion de colocation simplifiée</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-900 bg-white antialiased">
    @include('layouts.navigation')

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="text-left max-w-2xl lg:w-1/2">
                    <h1 class="text-5xl lg:text-7xl font-bold text-slate-900 mb-6 leading-tight tracking-tight">
                        Vivez <span class="text-blue-600">mieux</span> ensemble.
                    </h1>
                    <p class="text-lg text-slate-500 mb-8 max-w-lg font-medium leading-relaxed">
                        La plateforme simple et intuitive pour gérer votre colocation. Dépenses, tâches et loyers en toute sérénité.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                            Commencer gratuitement
                        </a>
                        <a href="#features" class="px-8 py-4 bg-slate-50 text-slate-700 font-bold rounded-xl hover:bg-slate-100 transition-all border border-slate-200">
                            En savoir plus
                        </a>
                    </div>
                </div>
                
                <div class="lg:w-1/2 relative">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-blue-50 rounded-[2rem] -rotate-2"></div>
                        <div class="relative bg-white p-3 rounded-[2rem] shadow-xl border border-slate-100">
                            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80" alt="Apartment Interior" class="rounded-[1.5rem] object-cover aspect-[4/3] w-full">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-slate-900 mb-2">+10k</div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Utilisateurs</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-slate-900 mb-2">98%</div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Satisfaction</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-slate-900 mb-2">4.9/5</div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Note Mobile</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-slate-900 mb-2">24/7</div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Tout ce dont vous avez besoin</h2>
                <p class="text-slate-500 font-medium">Une solution complète pour harmoniser votre vie à plusieurs.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Share Expenses -->
                <div class="card-simple group">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Dépenses Partagées</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Ajoutez vos achats en un clic et laissez EasyColoc équilibrer les comptes automatiquement.</p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">
                            <span class="w-1 h-1 bg-blue-500 rounded-full"></span> Transparence Totale
                        </li>
                    </ul>
                </div>

                <!-- Recurring Tasks -->
                <div class="card-simple group">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-green-600 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Tâches Ménagères</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Planifiez le ménage, les courses et les sorties avec un calendrier partagé et des rappels intelligents.</p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">
                            <span class="w-1 h-1 bg-green-500 rounded-full"></span> Équitable pour tous
                        </li>
                    </ul>
                </div>

                <!-- Instant Chat -->
                <div class="card-simple group">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Communication</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Discutez en temps réel avec vos colocataires pour une organisation fluide et sans frictions.</p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">
                            <span class="w-1 h-1 bg-indigo-500 rounded-full"></span> Toujours connecté
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-slate-400">
            <p class="text-xs font-bold uppercase tracking-widest">&copy; {{ date('Y') }} EasyColoc. Simple o Nadi.</p>
        </div>
    </footer>
</body>
</html>
