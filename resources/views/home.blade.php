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
    
    @vite(['resources/css/app.css', 'resources/css/home.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-900 bg-[#f8fafc] antialiased selection:bg-blue-100 selection:text-blue-900">
    @include('layouts.navigation')

    <!-- Hero Section -->
    <section class="relative pt-40 pb-24 lg:pt-56 lg:pb-40 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 right-0 -z-0 w-[800px] h-[800px] bg-blue-50/50 rounded-full blur-[120px] -mr-96 -mt-96 pointer-events-none"></div>
        <div class="absolute top-1/2 left-0 -z-0 w-[600px] h-[600px] bg-indigo-50/30 rounded-full blur-[100px] -ml-48 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="text-left max-w-2xl animate-fade-in lg:w-1/2">
                    <div class="inline-flex items-center px-4 py-2 bg-blue-50/80 backdrop-blur-sm text-blue-600 rounded-full text-xs font-black mb-8 border border-blue-100 uppercase tracking-widest">
                        <span class="w-2 h-2 rounded-full bg-blue-600 mr-2 animate-pulse"></span>
                        L'application n°1 pour colocataires
                    </div>
                    <h1 class="text-6xl lg:text-8xl font-black text-slate-900 mb-8 leading-[1.05] font-heading tracking-tight">
                        Vivez <span class="text-gradient">mieux</span> ensemble.
                    </h1>
                    <p class="text-xl text-slate-500 mb-12 leading-relaxed max-w-xl font-medium">
                        EasyColoc simplifie votre quotidien en communauté. Dépenses partagées, équilibre des comptes et communication fluide, tout devient instantané.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-blue-600 text-white text-lg font-black rounded-2xl hover:bg-blue-700 transition shadow-2xl shadow-blue-200 transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3">
                            Commencer l'aventure
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="#features" class="w-full sm:w-auto px-10 py-5 bg-white text-slate-700 text-lg font-bold rounded-2xl hover:bg-slate-50 transition border border-slate-200 shadow-sm flex items-center justify-center">
                            En savoir plus
                        </a>
                    </div>
                    
                    <!-- Trust Badge -->
                    <div class="mt-16 flex items-center gap-4 grayscale opacity-70">
                        <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-200"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-300"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-400"></div>
                        </div>
                        <p class="text-sm font-bold text-slate-400 font-heading">+12,000 colocataires nous font confiance</p>
                    </div>
                </div>
                
                <div class="lg:w-1/2 relative">
                    <div class="relative animate-float">
                        <div class="absolute inset-0 bg-blue-600 rounded-[3rem] rotate-3 blur-3xl opacity-10"></div>
                        <div class="relative bg-white p-4 rounded-[3rem] shadow-2xl border border-slate-100">
                             <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&q=80&w=2070" 
                                 alt="Apartment Interior" 
                                 class="rounded-[2.5rem] object-cover aspect-[4/3] w-full shadow-inner">
                        </div>
                        
                        <!-- Floating Card 1 -->
                        <div class="absolute -bottom-10 -left-10 bg-white/90 backdrop-blur-md p-6 rounded-3xl shadow-2xl z-20 hidden md:block border border-white/50 animate-fade-in group">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center shadow-inner">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div>
                                    <div class="text-xs font-black text-slate-400 uppercase tracking-widest mb-0.5">Dépense validée</div>
                                    <div class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors tracking-tight">Courses par Sarah</div>
                                </div>
                                <div class="text-blue-600 font-black ml-4 text-lg">24.50€</div>
                            </div>
                        </div>

                        <!-- Floating Card 2 -->
                        <div class="absolute -top-10 -right-6 bg-white/90 backdrop-blur-md p-6 rounded-3xl shadow-2xl z-20 hidden md:block border border-white/50 animate-fade-in delay-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 rounded-full bg-blue-500 animate-pulse"></div>
                                <div class="text-xs font-black text-slate-800 uppercase tracking-widest">Paiements à jour</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 bg-slate-900 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[1px] bg-gradient-to-r from-transparent via-blue-500/30 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-24 text-center">
                <div class="space-y-2">
                    <div class="text-5xl lg:text-6xl font-black text-white mb-2 font-heading tracking-tighter">50k+</div>
                    <div class="text-blue-400 uppercase tracking-widest text-[10px] font-black">Colocataires</div>
                </div>
                <div class="space-y-2">
                    <div class="text-5xl lg:text-6xl font-black text-white mb-2 font-heading tracking-tighter">12k+</div>
                    <div class="text-blue-400 uppercase tracking-widest text-[10px] font-black">Appartements</div>
                </div>
                <div class="space-y-2">
                    <div class="text-5xl lg:text-6xl font-black text-white mb-2 font-heading tracking-tighter">€4M+</div>
                    <div class="text-blue-400 uppercase tracking-widest text-[10px] font-black">Frais gérés</div>
                </div>
                <div class="space-y-2">
                    <div class="text-5xl lg:text-6xl font-black text-white mb-2 font-heading tracking-tighter">4.9/5</div>
                    <div class="text-blue-400 uppercase tracking-widest text-[10px] font-black">Note App Store</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-32 bg-[#f8fafc] relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-24 max-w-3xl mx-auto">
                <h2 class="text-4xl lg:text-6xl font-black text-slate-900 mb-8 tracking-tight font-heading">Pensé pour le collectif</h2>
                <div class="w-24 h-1.5 bg-blue-600 mx-auto rounded-full mb-8"></div>
                <p class="text-xl text-slate-500 font-medium">Plus question de s'écharper pour savoir qui a payé quoi. On s'occupe de tout, pour que vous profitiez du moment.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="p-10 rounded-[3rem] bg-white border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
                    <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center mb-10 shadow-inner group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 font-heading">Comptes simplifiés</h3>
                    <p class="text-slate-500 leading-relaxed font-medium">Centralisez vos dépenses partagées. L'app calcule qui doit combien à qui en un éclair, sans erreur.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="p-10 rounded-[3rem] bg-white border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
                    <div class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-3xl flex items-center justify-center mb-10 shadow-inner group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04M12 3V1m0 21V5m0 0a11.952 11.952 0 00-6.827 2.189M12 5a11.952 11.952 0 016.827 2.189m-6.827 0A11.952 11.952 0 0112 5.056a11.952 11.952 0 016.827 1.133M12 21a9.003 9.003 0 008.313-5.547M12 21a9.003 9.003 0 01-8.313-5.547" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 font-heading">Missions Coloc</h3>
                    <p class="text-slate-500 leading-relaxed font-medium">Planning intelligent des tâches ménagères. Recevez des notifications et gardez un lieu de vie impeccable.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="p-10 rounded-[3rem] bg-white border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
                    <div class="w-20 h-20 bg-blue-50 text-blue-400 rounded-3xl flex items-center justify-center mb-10 shadow-inner group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 font-heading">Suivi Instantané</h3>
                    <p class="text-slate-500 leading-relaxed font-medium">Gardez un œil sur les versements de chacun. Une transparence totale pour une colocation sans stress.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-20 relative">
        <div class="absolute top-0 left-0 w-full h-[1px] bg-white/5"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-8">
                        <div class="h-10 w-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-black text-xl">E</div>
                        <span class="ml-3 text-2xl font-black text-white tracking-tight font-heading">EasyColoc</span>
                    </div>
                    <p class="text-slate-500 max-w-sm font-medium">L'application qui rend la colocation plus humaine, plus simple et plus fun. Créée par des colocataires, pour des colocataires.</p>
                </div>
                <div>
                    <h4 class="text-white font-black uppercase tracking-widest text-xs mb-6 font-heading">Produit</h4>
                    <ul class="space-y-4 text-sm font-bold">
                        <li><a href="#" class="hover:text-blue-500 transition-colors">Fonctionnalités</a></li>
                        <li><a href="#" class="hover:text-blue-500 transition-colors">Tarifs</a></li>
                        <li><a href="#" class="hover:text-blue-500 transition-colors">Démo</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-black uppercase tracking-widest text-xs mb-6 font-heading">Légal</h4>
                    <ul class="space-y-4 text-sm font-bold">
                        <li><a href="#" class="hover:text-blue-500 transition-colors">Conditions</a></li>
                        <li><a href="#" class="hover:text-blue-500 transition-colors">Confidentialité</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-10 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-xs font-black text-slate-600 uppercase tracking-widest">
                    &copy; {{ date('Y') }} EasyColoc. Tous droits réservés.
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

