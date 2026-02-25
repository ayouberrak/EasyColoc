<x-app-layout>
    <div class="py-16 bg-slate-50 min-h-[calc(100vh-64px)] overflow-hidden relative">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="animate-fade-in space-y-8">
                <div class="card-simple bg-white p-8 sm:p-12 border border-slate-100 shadow-xl shadow-slate-100/50">
                    <div class="mb-10 text-center">
                        <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-600 text-white rounded-xl mb-6 shadow-lg shadow-blue-100">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-slate-900 mb-2 tracking-tight">Nouvelle Colocation</h1>
                        <p class="text-slate-500 font-medium">Donnez un nom à votre futur espace partagé.</p>
                    </div>

                    <form action="{{ route('colocations.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="space-y-4">
                            <!-- Name Input -->
                            <div class="space-y-1.5">
                                <label for="name" class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Nom de la colocation</label>
                                <input type="text" name="name" id="name" required 
                                       class="block w-full px-6 py-4 bg-slate-50 border-transparent rounded-xl text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all placeholder:text-slate-300 font-bold"
                                       placeholder="Ex: Villa des Amis, Appart 42...">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Description Input -->
                            <div class="space-y-1.5">
                                <label for="description" class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Description (Optionnel)</label>
                                <textarea name="description" id="description" rows="3" 
                                          class="block w-full px-6 py-4 bg-slate-50 border-transparent rounded-xl text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all placeholder:text-slate-300 font-medium"
                                          placeholder="Décrivez brièvement l'ambiance..."></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="pt-4 flex flex-col gap-3">
                            <button type="submit" 
                                    class="w-full px-8 py-4 bg-blue-600 text-white text-[11px] font-bold rounded-xl uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-blue-100">
                                Lancer la colocation
                            </button>
                            <a href="{{ route('dashboard') }}" 
                               class="w-full px-8 py-4 bg-white text-slate-400 text-[11px] font-bold rounded-xl uppercase tracking-widest hover:bg-slate-50 transition border border-slate-100 text-center">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Info Card -->
                <div class="p-6 bg-blue-50/50 rounded-2xl border border-blue-100 flex items-start gap-4">
                    <div class="w-10 h-10 bg-white text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm border border-blue-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-blue-900 mb-1 text-sm tracking-tight">C'est presque fini !</h4>
                        <p class="text-[11px] text-blue-600/70 leading-relaxed font-medium">Une fois créée, vous recevrez un lien unique pour inviter vos futurs colocataires à rejoindre l'aventure.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
