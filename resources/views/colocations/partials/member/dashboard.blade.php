<!-- TAB: MEMBER DASHBOARD (SIMPLE O NADI) -->
<div class="animate-fade-in space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-bold text-slate-900 tracking-tight leading-tight">Bonjour, {{ Auth::user()->name }} 👋</h1>
            <p class="text-slate-500 font-medium mt-1">Heureux de vous revoir dans la colocation <span class="text-blue-600 font-bold tracking-tight">{{ $colocation->name }}</span>.</p>
        </div>
        <div class="card-simple p-4 flex items-center gap-4 bg-white border border-slate-100">
            <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
            </div>
            <div>
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-none">Statut financier</p>
                <p class="text-sm font-bold text-slate-900 mt-1">À jour • Ce mois-ci</p>
            </div>
        </div>
    </div>

    <div>
        <form action="" method="POST">

                <Button type="submit">
                    sortir
                </Button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        <!-- Static Members for illustration (similar to original) -->
        <!-- Primary Focus (Situation de la Coloc) -->
        <div class="lg:col-span-8 space-y-10">
            <div class="card-simple bg-white border border-slate-100 overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 tracking-tight">Situation de la coloc</h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Transparence financière</p>
                        </div>
                    </div>
                </div>
                
                <div class="divide-y divide-slate-50">
                    @forelse($colocation->members as $member)
                        @php
                            if($member->user_id === Auth::id()) continue;
                            $toMe = $debts->where('debtor_id', $member->user_id)->where('creditor_id', Auth::id())->first();
                            $fromMe = $debts->where('debtor_id', Auth::id())->where('creditor_id', $member->user_id)->first();
                            $balance = ($toMe ? $toMe->amount : 0) - ($fromMe ? $fromMe->amount : 0);
                        @endphp
                        <div class="p-6 flex items-center justify-between hover:bg-slate-50/50 transition-all">
                            <div class="flex items-center gap-6">
                                <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center font-bold text-slate-800 text-xl border border-slate-100 shadow-sm">
                                    {{ substr($member->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-slate-900 tracking-tight">{{ $member->user->name }}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $member->user_id === $colocation->user_id ? 'Propriétaire' : 'Colocataire' }}</span>
                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                        <span class="text-[9px] font-bold uppercase tracking-widest {{ $balance < 0 ? 'text-red-500' : ($balance > 0 ? 'text-green-600' : 'text-slate-400') }}">
                                            {{ $balance < 0 ? 'En attente' : ($balance > 0 ? 'Payé en plus' : 'À jour') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xl font-bold {{ $balance < 0 ? 'text-red-600' : ($balance > 0 ? 'text-green-600' : 'text-slate-400') }} tracking-tight">
                                    {{ number_format(abs($balance), 2) }} <span class="text-[10px] font-medium opacity-60">DH</span>
                                </div>
                                <p class="text-[9px] font-bold uppercase tracking-widest {{ $balance < 0 ? 'text-red-400' : ($balance > 0 ? 'text-green-400' : 'text-slate-300') }}">
                                    {{ $balance < 0 ? 'vous lui devez' : ($balance > 0 ? 'il vous doit' : '-') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-slate-400 text-sm font-medium">Aucun autre membre dans cette colocation.</div>
                    @endforelse
                </div>
                
                <div class="bg-slate-900 p-8 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Mon solde global</p>
                        @php
                            $myTotalToOthers = $debts->where('debtor_id', Auth::id())->sum('amount');
                            $othersTotalToMe = $debts->where('creditor_id', Auth::id())->sum('amount');
                            $myGlobalBalance = $othersTotalToMe - $myTotalToOthers;
                        @endphp
                        <p class="text-2xl font-bold {{ $myGlobalBalance < 0 ? 'text-red-400' : ($myGlobalBalance > 0 ? 'text-green-400' : 'text-white') }} tracking-tight">
                            {{ number_format($myGlobalBalance, 2) }} <span class="text-sm font-medium opacity-50 ml-1">DH</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: My Part -->
        <div class="lg:col-span-4 space-y-10 lg:sticky lg:top-36">
            <div class="card-simple p-8 bg-white border border-slate-100 shadow-xl shadow-slate-100/50">
                <h3 class="text-xl font-bold text-slate-900 mb-6 tracking-tight">Ma Part Mensuelle</h3>
                <div class="space-y-6">
                    <div class="flex items-end gap-2">
                        <span class="text-4xl font-bold text-slate-900 tracking-tight">1,166</span>
                        <span class="text-sm font-bold text-slate-400 uppercase mb-2">DH</span>
                    </div>
                    <div class="space-y-2">
                        <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-blue-600 h-full w-[65%] rounded-full shadow-[0_0_10px_rgba(37,99,235,0.2)]"></div>
                        </div>
                        <div class="flex items-center justify-between text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            <span>Encaissement global</span>
                            <span class="text-blue-600">65%</span>
                        </div>
                    </div>
                    <button class="w-full py-4 bg-blue-600 text-white text-[10px] font-bold rounded-xl uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-blue-100">Régler maintenant</button>
                </div>
            </div>

            <div class="bg-blue-600 p-8 rounded-[2rem] text-white shadow-xl shadow-blue-100">
                <p class="text-[10px] font-bold text-blue-100 uppercase tracking-widest mb-2 opacity-80">Status de la coloc</p>
                <div class="text-2xl font-bold tracking-tight mb-4">Tout est OK ! ✨</div>
                <p class="text-xs font-medium text-blue-50 leading-relaxed mb-6">
                    Aucun retard critique détecté. La gestion est saine ce mois-ci.
                </p>
                <div class="flex -space-x-2">
                    @foreach($colocation->members as $m)
                        <div class="w-8 h-8 rounded-full border-2 border-blue-600 bg-blue-500 flex items-center justify-center text-[10px] font-bold" title="{{ $m->user->name }}">
                            {{ substr($m->user->name, 0, 1) }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
