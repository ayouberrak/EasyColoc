<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Créer une nouvelle colocation') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-[calc(100vh-64px)] overflow-hidden relative">
        <!-- Decoration Gradients -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[600px] h-[600px] bg-blue-100 rounded-full blur-3xl opacity-30 -z-0"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-[500px] h-[500px] bg-indigo-100 rounded-full blur-3xl opacity-30 -z-0"></div>

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="animate-fade-in">
                <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl shadow-blue-100/50 sm:rounded-[2.5rem] border border-white">
                    <div class="p-8 sm:p-12">
                        <div class="mb-10 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 text-white rounded-2xl mb-6 shadow-lg shadow-blue-200">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Nouvelle Aventure !</h1>
                            <p class="text-slate-500">Donnez un nom et une âme à votre futur espace partagé.</p>
                        </div>

                        <form action="{{ route('colocations.store') }}" method="POST" class="space-y-8">
                            @csrf
                            
                            <div class="space-y-6">
                                <!-- Name Input -->
                                <div>
                                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2 px-1">Nom de la colocation</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                        </div>
                                        <input type="text" name="name" id="name" required 
                                               class="block w-full pl-11 pr-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all placeholder:text-slate-400"
                                               placeholder="Ex: Villa des Amis, Appart 42...">
                                    </div>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Description Input -->
                                <div>
                                    <label for="description" class="block text-sm font-bold text-slate-700 mb-2 px-1">Description (Optionnel)</label>
                                    <div class="relative group">
                                        <div class="absolute top-4 left-4 pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                            </svg>
                                        </div>
                                        <textarea name="description" id="description" rows="4" 
                                                  class="block w-full pl-11 pr-4 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all placeholder:text-slate-400"
                                                  placeholder="Décrivez l'ambiance ou les règles de base..."></textarea>
                                    </div>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                            </div>

                            <div class="pt-4 flex flex-col sm:flex-row gap-4">
                                <button type="submit" 
                                        class="flex-1 px-8 py-5 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 transition shadow-xl shadow-blue-200 transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2">
                                    <span>Lancer la colocation</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </button>
                                <a href="{{ route('dashboard') }}" 
                                   class="px-8 py-5 bg-white text-slate-600 font-bold rounded-2xl hover:bg-slate-50 transition border border-slate-200 text-center">
                                    Annuler
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="mt-8 p-6 bg-indigo-50 rounded-[2rem] border border-indigo-100 flex items-start gap-4">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-indigo-900 mb-1">C'est presque fini !</h4>
                        <p class="text-sm text-indigo-700 leading-relaxed">Une fois créée, vous recevrez un lien unique pour inviter vos futurs colocataires à rejoindre l'aventure.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-app-layout>
