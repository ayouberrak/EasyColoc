<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Mon Historique de Colocations</h1>
                <p class="text-slate-500 font-medium">Retrouvez toutes les colocations dont vous avez fait partie.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($memberships as $membership)
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-100">
                                    {{ substr($membership->colocation->name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900">{{ $membership->colocation->name }}</h3>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $membership->role === 'owner' ? 'Propriétaire' : 'Membre' }}</p>
                                </div>
                            </div>
                            @if(!$membership->left_at)
                                <span class="px-2 py-1 bg-emerald-50 text-emerald-600 text-[8px] font-black uppercase tracking-widest rounded-lg border border-emerald-100 shadow-sm">Actuelle</span>
                            @else
                                <span class="px-2 py-1 bg-slate-50 text-slate-400 text-[8px] font-black uppercase tracking-widest rounded-lg border border-slate-100">Passée</span>
                            @endif
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-400 font-bold uppercase text-[9px] tracking-widest">Propriétaire</span>
                                <span class="text-slate-700 font-bold tracking-tight">{{ $membership->colocation->owner->name }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-400 font-bold uppercase text-[9px] tracking-widest">Rejoint le</span>
                                <span class="text-slate-700 font-bold tracking-tight">{{ $membership->created_at->format('d/m/Y') }}</span>
                            </div>
                            @if($membership->left_at)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-400 font-bold uppercase text-[9px] tracking-widest">Quitté le</span>
                                <span class="text-slate-700 font-bold tracking-tight">{{ $membership->left_at->format('d/m/Y') ?? 'Annulé' }}</span>
                            </div>
                            @endif
                        </div>

                        <div class="p-4 bg-slate-50/50 border-t border-slate-50">
                            @if(!$membership->left_at)
                                @if($membership->role === 'owner')
                                    <a href="{{ route('owner.dashboard', ['colocation_id' => $membership->colocation_id]) }}" class="block w-full text-center py-2.5 bg-blue-600 text-white text-xs font-black rounded-xl hover:bg-blue-700 transition-colors shadow-lg shadow-blue-100 uppercase tracking-widest">Accéder au Dashboard</a>
                                @else
                                    <a href="{{ route('dashboard', ['colocation_id' => $membership->colocation_id]) }}" class="block w-full text-center py-2.5 bg-white text-blue-600 border border-blue-200 text-xs font-black rounded-xl hover:bg-blue-50 transition-colors shadow-sm">Accéder à la Balance</a>
                                @endif
                            @else
                                <button disabled class="w-full py-2.5 bg-slate-100 text-slate-400 text-xs font-black rounded-xl cursor-not-allowed uppercase tracking-widest">Archives Read-Only</button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-3xl border border-slate-100 p-12 text-center">
                        <div class="text-slate-300 mb-4">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h2 class="text-xl font-bold text-slate-800">Aucun historique</h2>
                        <p class="text-slate-500 mt-2">Vous n'avez pas encore rejoint de colocation.</p>
                        <a href="{{ route('home') }}" class="inline-block mt-6 px-8 py-3 bg-blue-600 text-white font-black text-sm rounded-2xl shadow-lg shadow-blue-100 hover:scale-105 transition-transform">Explorer les colocations</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
