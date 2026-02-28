<!-- TAB: STATS & BALANCE -->
<div class="animate-fade-in space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Bonjour, {{ Auth::user()->name }} </h1>
            <p class="text-slate-500 font-medium">Gérez votre colocation <span class="text-blue-600 font-bold">{{ $colocation->name }}</span>.</p>
        </div>
        
        <div>
            <a href="{{ route('owner.colocation.export-pdf') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-sm transition-all focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Générer le Rapport PDF
            </a>
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
                    $toMe = $debts->where('debtor_id', $member->user_id)->where('creditor_id', Auth::id())->first();
                    $fromMe = $debts->where('debtor_id', Auth::id())->where('creditor_id', $member->user_id)->first();
                    $balance = ($toMe ? $toMe->amount : 0) - ($fromMe ? $fromMe->amount : 0);
                    $isSelf = $member->user_id === Auth::id();
                @endphp
                <div class="p-6 flex items-center justify-between hover:bg-slate-50/80 transition-all group {{ $isSelf ? 'bg-blue-50/20' : '' }}">
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center font-black text-slate-800 text-2xl border border-slate-100 shadow-sm group-hover:rotate-2 transition-transform">
                                {{ substr($member->user->name, 0, 1) }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 flex items-center gap-1 px-1.5 py-0.5 bg-amber-400 text-white text-[8px] font-black rounded-lg border-2 border-white shadow-sm ring-1 ring-amber-100">
                                <svg class="w-2 h-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                {{ $member->reputation ?? 0 }}
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2.5">
                                <p class="text-xl font-black text-slate-900 tracking-tight">{{ $member->user->name }}</p>
                                @if($isSelf)
                                    <span class="px-2 py-0.5 bg-blue-600 text-white text-[9px] font-black rounded-md uppercase tracking-widest shadow-lg shadow-blue-100 italic">Proprio</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-3 mt-1.5">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Membre</span>
                                <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                <span class="text-[10px] font-extrabold uppercase tracking-widest {{ $isSelf ? 'text-blue-500' : ($balance > 0 ? 'text-emerald-600' : ($balance < 0 ? 'text-rose-500' : 'text-slate-400')) }}">
                                    @if($isSelf)
                                        <span class="flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                            En ligne
                                        </span>
                                    @else
                                        {{ $balance > 0 ? 'il vous doit' : ($balance < 0 ? 'à régulariser' : 'à jour') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    @if(!$isSelf)
                        <div class="text-right flex flex-col items-end gap-1">
                            <div class="flex items-baseline gap-1.5">
                                <span class="text-2xl font-black {{ $balance > 0 ? 'text-emerald-600' : ($balance < 0 ? 'text-rose-600' : 'text-slate-400') }} tracking-tighter">
                                    {{ number_format(abs($balance), 2) }}
                                </span>
                                <span class="text-[11px] font-bold text-slate-400 uppercase">DH</span>
                            </div>
                            <div class="flex items-center gap-1.5 px-2 py-0.5 rounded-md {{ $balance > 0 ? 'bg-emerald-50' : ($balance < 0 ? 'bg-rose-50' : 'bg-slate-50') }}">
                                @if($balance > 0)
                                    <svg class="w-2.5 h-2.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                                @elseif($balance < 0)
                                    <svg class="w-2.5 h-2.5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                                @endif
                                <p class="text-[9px] font-black uppercase tracking-widest {{ $balance > 0 ? 'text-emerald-600' : ($balance < 0 ? 'text-rose-500' : 'text-slate-400') }}">
                                    {{ $balance > 0 ? 'doit vous régler' : ($balance < 0 ? 'vous lui devez' : 'équilibre parfait') }}
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="hidden md:flex flex-col items-end opacity-20">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04M12 2.944a11.955 11.955 0 01-8.618 3.04M12 2.944V21m0-18.056c4.959 0 9.047 3.242 10.432 7.745M4.432 10.689C5.817 6.186 9.905 2.944 14.864 2.944" /></svg>
                        </div>
                    @endif
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
        <form action="{{ route('owner.colocation.cancel') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette colocation ? Cette action est irréversible.');">
            @csrf
            <button type="submit" class="px-4 py-2 bg-white text-red-600 border border-red-200 rounded-lg text-xs font-bold hover:bg-red-600 hover:text-white transition-all">
                Supprimer la Colocation
            </button>
        </form>
    </div>
</div>
