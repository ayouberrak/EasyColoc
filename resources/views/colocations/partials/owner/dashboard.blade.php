<!-- TAB: STATS & BALANCE -->
<div class="animate-fade-in space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Bonjour, {{ Auth::user()->name }} 👋</h1>
            <p class="text-slate-500 font-medium">Gérez votre colocation <span class="text-blue-600 font-bold">{{ $colocation->name }}</span>.</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card-simple">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Global</span>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Dépenses Totales</p>
            <div class="text-2xl font-bold text-slate-900">{{ number_format($totalExp ?? 0, 2) }} DH</div>
        </div>

        <div class="card-simple">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-green-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <span class="text-[10px] font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded uppercase tracking-widest text-right">Reçu</span>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Réglé</p>
            <div class="text-2xl font-bold text-slate-900">{{ number_format($totalPay ?? 0, 2) }} DH</div>
            <div class="w-full bg-slate-100 h-1.5 mt-4 rounded-full overflow-hidden">
                @php $percent = $totalExp > 0 ? min(100, ($totalPay / $totalExp) * 100) : 0; @endphp
                <div class="bg-green-500 h-full rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
            </div>
        </div>

        <div class="card-simple bg-blue-600 border-none">
            <div class="flex items-center justify-between mb-4 text-white">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                </div>
                <span class="text-[10px] font-bold bg-white/20 px-2 py-1 rounded-md uppercase tracking-widest">En attente</span>
            </div>
            <p class="text-xs font-bold text-blue-100 uppercase tracking-widest mb-1">Reste à percevoir</p>
            <div class="text-2xl font-bold text-white">{{ number_format(($totalExp ?? 0) - ($totalPay ?? 0), 2) }} DH</div>
        </div>
    </div>

    <!-- Situation des membres -->
    <div class="card-simple overflow-hidden !p-0 bg-white border border-slate-100">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
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
            @foreach($colocation->members as $member)
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
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Colocataire</span>
                                <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                <span class="text-[9px] font-bold uppercase tracking-widest {{ $balance > 0 ? 'text-green-600' : ($balance < 0 ? 'text-red-500' : 'text-slate-400') }}">
                                    {{ $balance > 0 ? 'Payé en plus' : ($balance < 0 ? 'En attente' : 'À jour') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xl font-bold {{ $balance > 0 ? 'text-green-600' : ($balance < 0 ? 'text-red-600' : 'text-slate-400') }} tracking-tight">
                            {{ number_format(abs($balance), 2) }} <span class="text-[10px] font-medium opacity-60">DH</span>
                        </div>
                        <p class="text-[9px] font-bold uppercase tracking-widest {{ $balance > 0 ? 'text-green-400' : ($balance < 0 ? 'text-red-400' : 'text-slate-300') }}">
                            {{ $balance > 0 ? 'il vous doit' : ($balance < 0 ? 'vous lui devez' : '-') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="bg-slate-900 p-8 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Mon solde global personnel</p>
                @php
                    $myTotalToOthers = $debts->where('debtor_id', Auth::id())->sum('amount');
                    $othersTotalToMe = $debts->where('creditor_id', Auth::id())->sum('amount');
                    $myGlobalBalance = $othersTotalToMe - $myTotalToOthers;
                @endphp
                <p class="text-2xl font-bold {{ $myGlobalBalance < 0 ? 'text-red-400' : ($myGlobalBalance > 0 ? 'text-green-400' : 'text-white') }} tracking-tight">
                    {{ number_format($myGlobalBalance, 2) }} <span class="text-sm font-medium opacity-50 ml-1">DH</span>
                </p>
            </div>
            <div class="flex flex-col items-end">
                <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mb-1">Status</span>
                <span class="px-3 py-1 bg-white/10 text-white text-[10px] font-bold rounded-lg uppercase tracking-widest">
                    {{ $myGlobalBalance >= 0 ? 'Sain' : 'À régulariser' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Journal des Dettes (Teslaf) -->
    <div class="card-simple overflow-hidden !p-0">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
            <div>
                <h3 class="text-lg font-bold text-slate-900 font-heading">Journal des Dettes (Teslaf)</h3>
                <p class="text-slate-500 text-xs font-medium">Tableau récapitulatif des balances entre membres.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 bg-amber-50 text-amber-600 text-[9px] font-bold rounded uppercase tracking-widest border border-amber-100">Bilatéral</span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left bg-slate-50/50">
                        <th class="py-3 px-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Débiteur (Doit)</th>
                        <th class="py-3 px-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Vers</th>
                        <th class="py-3 px-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Créancier (Est dû)</th>
                        <th class="py-3 px-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Montant</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($debts ?? [] as $debt)
                        @if($debt->amount > 0)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="py-4 px-6 flex items-center gap-3">
                                    <div class="w-8 h-8 bg-white border border-slate-100 rounded-lg flex items-center justify-center font-bold text-slate-600 text-[10px] shadow-sm">
                                        {{ substr($debt->debtor->name, 0, 1) }}
                                    </div>
                                    <span class="font-semibold text-slate-900 text-sm whitespace-nowrap">{{ $debt->debtor->name }}</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <svg class="w-4 h-4 text-slate-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-end gap-3">
                                        <span class="font-semibold text-slate-900 text-sm whitespace-nowrap">{{ $debt->creditor->name }}</span>
                                        <div class="w-8 h-8 bg-blue-50 border border-blue-100 rounded-lg flex items-center justify-center font-bold text-blue-600 text-[10px] shadow-sm">
                                            {{ substr($debt->creditor->name, 0, 1) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <span class="text-sm font-bold text-slate-900">{{ number_format($debt->amount, 2) }} <span class="text-[10px] opacity-50">DH</span></span>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest italic">Aucune dette bilatérale active</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="card-simple border-red-100 bg-red-50/30 flex items-center justify-between p-6">
        <div>
            <h3 class="text-base font-bold text-slate-900">Zone de danger</h3>
            <p class="text-slate-500 text-xs mt-0.5">La suppression est irréversible.</p>
        </div>
        <button type="button" class="px-4 py-2 bg-white text-red-600 border border-red-200 rounded-lg text-xs font-bold hover:bg-red-600 hover:text-white transition-all">
            Supprimer la Colocation
        </button>
    </div>
</div>
