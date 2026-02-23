<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EasyColoc - La gestion de colocation simplifiée</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/css/home.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-900 bg-slate-50 antialiased">
    @include('layouts.navigation')

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="text-left max-w-2xl animate-fade-in lg:w-1/2">
                    <div class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm font-bold mb-6 border border-blue-100 uppercase tracking-wider">
                        🏠 L'application n°1 pour colocataires
                    </div>
                    <h1 class="text-6xl lg:text-7xl font-extrabold text-slate-900 mb-8 leading-[1.1]">
                        Vivez <span class="text-gradient">mieux</span> ensemble.
                    </h1>
                    <p class="text-xl text-slate-600 mb-10 leading-relaxed max-w-xl">
                        EasyColoc simplifie votre quotidien en communauté. Dépenses partagées, planning de ménage et chat en temps réel, tout devient simple.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-blue-600 text-white text-lg font-bold rounded-2xl hover:bg-blue-700 transition shadow-2xl shadow-blue-200 transform hover:-translate-y-1 glow-on-hover text-center">
                            Essayer gratuitement
                        </a>
                        <a href="#features" class="w-full sm:w-auto px-10 py-5 bg-white text-slate-700 text-lg font-bold rounded-2xl hover:bg-slate-50 transition border border-slate-200 shadow-sm text-center">
                            Voir la démo
                        </a>
                    </div>
                </div>
                
                <div class="lg:w-1/2 animate-float">
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-600 rounded-[3rem] rotate-3 blur-2xl opacity-10"></div>
                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&q=80&w=2070" 
                             alt="Apartment Interior" 
                             class="rounded-[2.5rem] shadow-2xl relative z-10 border-8 border-white object-cover aspect-[4/3]">
                        
                        <!-- Floating Card 1 -->
                        <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-3xl shadow-xl z-20 hidden md:block border border-slate-100 animate-fade-in">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-slate-900">Courses payées</div>
                                    <div class="text-xs text-slate-500">Par Sarah il y a 5 min</div>
                                </div>
                                <div class="text-blue-600 font-bold ml-4">24.50€</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decoration -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[800px] h-[800px] bg-blue-100 rounded-full blur-3xl opacity-20 -z-10"></div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 text-center">
                <div>
                    <div class="text-5xl font-extrabold text-blue-400 mb-2">50k+</div>
                    <div class="text-slate-400 uppercase tracking-widest text-sm font-bold">Colocataires</div>
                </div>
                <div>
                    <div class="text-5xl font-extrabold text-blue-400 mb-2">12k+</div>
                    <div class="text-slate-400 uppercase tracking-widest text-sm font-bold">Appartements</div>
                </div>
                <div>
                    <div class="text-5xl font-extrabold text-blue-400 mb-2">€4M+</div>
                    <div class="text-slate-400 uppercase tracking-widest text-sm font-bold">Frais gérés</div>
                </div>
                <div>
                    <div class="text-5xl font-extrabold text-blue-400 mb-2">4.9/5</div>
                    <div class="text-slate-400 uppercase tracking-widest text-sm font-bold">Note App Store</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20 max-w-3xl mx-auto">
                <h2 class="text-4xl lg:text-5xl font-bold text-slate-900 mb-6 tracking-tight">Pensé pour le collectif</h2>
                <p class="text-lg text-slate-600">Plus question de s'écharper pour savoir qui a acheté le liquide vaisselle ou qui doit passer l'aspirateur.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="p-10 rounded-[3rem] bg-slate-50 hover-scale group transition duration-300">
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-blue-200 group-hover:rotate-6 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Comptes d'apothicaire</h3>
                    <p class="text-slate-600 leading-relaxed">Centralisez vos dépenses partagées. L'app calcule qui doit combien à qui en un éclair.</p>
                </div>
                
                <div class="p-10 rounded-[3rem] bg-slate-50 hover-scale group transition duration-300">
                    <div class="w-16 h-16 bg-indigo-600 text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-indigo-200 group-hover:rotate-6 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Ménage maîtrisé</h3>
                    <p class="text-slate-600 leading-relaxed">Planning dynamique des tâches. Recevez des notifications pour vos tours et gardez un lieu sain.</p>
                </div>
                
                <div class="p-10 rounded-[3rem] bg-slate-50 hover-scale group transition duration-300">
                    <div class="w-16 h-16 bg-blue-400 text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-blue-100 group-hover:rotate-6 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Communication</h3>
                    <p class="text-slate-600 leading-relaxed">Un chat performant pour tout partager : infos, crises, ou invitations de dernière minute.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-6 md:mb-0">
                    <x-application-logo class="w-8 h-8 text-blue-500 fill-current" />
                    <span class="ml-3 text-xl font-bold text-white">EasyColoc</span>
                </div>
                <div class="text-sm">
                    &copy; {{ date('Y') }} EasyColoc. Tous droits réservés.
                </div>
                <div class="mt-6 md:mt-0 flex space-x-6">
                    <a href="#" class="hover:text-white transition">Conditions</a>
                    <a href="#" class="hover:text-white transition">Confidentialité</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
