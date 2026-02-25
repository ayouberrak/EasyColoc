<!-- TAB: MEMBERS VIEW (SIMPLE O NADI) -->
<div class="animate-fade-in space-y-12">
    <div>
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">L'équipe EasyColoc</h1>
        <p class="text-slate-500 font-medium mt-1">Vos colocataires de confiance dans <span class="text-blue-600 font-bold">{{ $colocation->name }}</span>.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($colocation->members as $member)
            <div class="card-simple p-8 bg-white text-center group border border-slate-100">
                <div class="relative inline-block mb-6">
                    <div class="w-20 h-20 bg-slate-50 rounded-2xl flex items-center justify-center font-bold text-slate-800 text-3xl border border-slate-100 group-hover:scale-105 group-hover:rotate-2 transition-transform duration-500">
                        {{ substr($member->user->name, 0, 1) }}
                    </div>
                    @if($member->user_id === Auth::id())
                        <div class="absolute -top-1.5 -right-1.5 w-7 h-7 bg-blue-600 text-white rounded-full flex items-center justify-center border-4 border-white shadow-md">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" /></svg>
                        </div>
                    @endif
                </div>
                <h4 class="text-xl font-bold text-slate-900 tracking-tight">{{ $member->user->name }}</h4>
                <div class="mt-2 flex items-center justify-center gap-2">
                     <span class="px-2.5 py-1 bg-slate-50 text-slate-500 text-[9px] font-bold rounded-lg border border-slate-100 uppercase tracking-widest">
                        {{ $member->user_id === $colocation->user_id ? 'Propriétaire' : 'Colocataire' }}
                     </span>
                     <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                </div>
                
                <div class="mt-8 pt-6 border-t border-slate-50 grid grid-cols-2 gap-4">
                    <div class="text-left">
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Depuis</p>
                        <p class="text-xs font-bold text-slate-800 mt-0.5">{{ $member->created_at->format('M Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Paiement</p>
                        <p class="text-xs font-bold text-green-600 mt-0.5">À jour</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
