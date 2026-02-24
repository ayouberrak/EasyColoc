<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[800px] h-[800px] bg-blue-50 rounded-full blur-[120px] opacity-40 -z-0"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-[600px] h-[600px] bg-indigo-50 rounded-full blur-[120px] opacity-40 -z-0"></div>

        <div class="max-w-md w-full space-y-8 relative z-10 transition-all duration-1000 animate-fade-in">
            <div class="text-center">
                <div class="mx-auto w-24 h-24 bg-white rounded-[2rem] shadow-2xl shadow-blue-100 flex items-center justify-center text-blue-600 mb-8 border border-white ring-8 ring-blue-50/50">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </div>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight font-heading leading-tight">Nouvelle Aventure ! 🏠</h2>
                <p class="mt-4 text-slate-500 font-medium">Vous avez été invité à rejoindre une colocation.</p>
            </div>

            <div class="premium-card p-10 bg-white shadow-2xl shadow-blue-100/40 border border-white space-y-8">
                <div class="text-center space-y-4">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-50 rounded-full text-[10px] font-black text-blue-600 uppercase tracking-widest border border-blue-100/50 shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                        Invitation de {{ $invitation->colocation->owner->name }}
                    </div>
                    <div class="text-3xl font-black text-slate-900 font-heading tracking-tight lowercase first-letter:uppercase">
                        {{ $invitation->colocation->name }}
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed italic">
                        "{{ $invitation->colocation->description }}"
                    </p>
                </div>

                <div class="pt-8 border-t border-slate-50 space-y-4">
                    <form action="{{ route('invitations.accept', $invitation->token) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-6 bg-blue-600 text-white font-black rounded-[1.5rem] hover:bg-slate-900 transition-all shadow-2xl shadow-blue-200 transform active:scale-[0.98] text-lg flex items-center justify-center gap-3 group">
                            Confirmer & Rejoindre
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </button>
                    </form>

                    <form action="{{ route('invitations.decline', $invitation->token) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-4 text-slate-400 hover:text-rose-500 font-bold transition-colors uppercase tracking-widest text-[11px]">
                            Refuser l'invitation
                        </button>
                    </form>
                </div>
            </div>

            <p class="text-center text-slate-400 text-[10px] uppercase font-black tracking-[0.2em]">
                EasyColoc &bull; La gestion simplifiée
            </p>
        </div>
    </div>

    <style>
        .animate-fade-in {
            opacity: 0;
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-app-layout>
