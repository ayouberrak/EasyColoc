<div class="animate-fade-in space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <div class="flex flex-wrap items-center gap-3 mb-2">
                <span class="px-3 py-1 bg-white border border-slate-100 text-slate-400 text-[10px] font-bold rounded-lg uppercase tracking-widest shadow-sm flex items-center gap-2">
                    <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    @php
                        $days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                        $months = ['01' => 'Janvier', '02' => 'Février', '03' => 'Mars', '04' => 'Avril', '05' => 'Mai', '06' => 'Juin', '07' => 'Juillet', '08' => 'Août', '09' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'];
                        echo $days[date('w')] . ' ' . date('d') . ' ' . $months[date('m')];
                    @endphp
                </span>
                <span class="px-3 py-1 bg-blue-50/50 border border-blue-100 text-blue-600 text-[10px] font-extrabold rounded-lg uppercase tracking-widest shadow-sm">
                    {{ $colocation->name }}
                </span>
                <span class="px-3 py-1 bg-slate-900 border border-slate-900 text-white text-[9px] font-black rounded-lg uppercase tracking-widest shadow-lg shadow-slate-200">
                    Proprio: {{ $colocation->owner->name }}
                </span>
            </div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight leading-tight">Bonjour, {{ Auth::user()->name }} 👋</h1>
            <p class="text-slate-500 font-medium mt-1">Heureux de vous revoir dans votre espace partagé.</p>
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

    <div class="flex items-center gap-4">
        <form action="{{ route('leave.colo') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir quitter cette colocation ?')">
            @csrf
            <button type="submit" class="group flex items-center gap-2 px-4 py-2.5 bg-white border border-red-100 text-red-500 rounded-xl text-[10px] font-bold uppercase tracking-widest hover:bg-red-500 hover:text-white hover:border-red-500 transition-all duration-300 shadow-sm shadow-red-50 mt-[-10px]">
                <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Quitter la coloc
            </button>
        </form>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
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
                            $toMe = $debts->where('debtor_id', $member->user_id)->where('creditor_id', Auth::id())->first();
                            $fromMe = $debts->where('debtor_id', Auth::id())->where('creditor_id', $member->user_id)->first();
                            $balance = ($toMe ? $toMe->amount : 0) - ($fromMe ? $fromMe->amount : 0);
                            $isSelf = $member->user_id === Auth::id();
                        @endphp
                        <div class="p-6 flex items-center justify-between hover:bg-slate-50/80 transition-all cursor-default group {{ $isSelf ? 'bg-blue-50/20' : '' }}">
                            <div class="flex items-center gap-6">
                                <div class="relative">
                                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center font-black text-slate-800 text-2xl border border-slate-100 shadow-sm group-hover:rotate-2 transition-transform">
                                        {{ substr($member->user->name, 0, 1) }}
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 flex items-center gap-1 px-1.5 py-0.5 bg-amber-400 text-white text-[8px] font-black rounded-lg border-2 border-white shadow-sm ring-1 ring-amber-100">
                                        <svg class="w-2 h-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                        {{ $member->user->reputation ?? 0 }}
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2.5">
                                        <p class="text-xl font-black text-slate-900 tracking-tight">{{ $member->user->name }}</p>
                                        @if($isSelf)
                                            <span class="px-2 py-0.5 bg-blue-600 text-white text-[9px] font-black rounded-md uppercase tracking-widest shadow-lg shadow-blue-100">Vous</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-3 mt-1.5">
                                        <div class="flex items-center gap-1.5">
                                            <div class="w-1.5 h-1.5 rounded-full {{ $member->user_id === $colocation->user_id ? 'bg-indigo-400' : 'bg-slate-300' }}"></div>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $member->user_id === $colocation->user_id ? 'Propriétaire' : 'Colocataire' }}</span>
                                        </div>
                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                        <div class="flex items-center gap-1.5">
                                            @if($isSelf)
                                                <span class="text-[10px] font-extrabold text-blue-500 uppercase tracking-widest flex items-center gap-1">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                                    Actif maintenant
                                                </span>
                                            @else
                                                <span class="text-[10px] font-extrabold uppercase tracking-widest {{ $balance < 0 ? 'text-rose-500' : ($balance > 0 ? 'text-emerald-600' : 'text-slate-400') }}">
                                                    {{ $balance < 0 ? 'En retard' : ($balance > 0 ? 'En avance' : 'Règlements à jour') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(!$isSelf)
                                <div class="text-right flex flex-col items-end gap-1">
                                    <div class="flex items-baseline gap-1.5">
                                        <span class="text-2xl font-black {{ $balance < 0 ? 'text-rose-600' : ($balance > 0 ? 'text-emerald-600' : 'text-slate-400') }} tracking-tighter">
                                            {{ number_format(abs($balance), 2) }}
                                        </span>
                                        <span class="text-[11px] font-bold text-slate-400 uppercase">DH</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 px-2 py-0.5 rounded-md {{ $balance < 0 ? 'bg-rose-50' : ($balance > 0 ? 'bg-emerald-50' : 'bg-slate-50') }}">
                                        @if($balance < 0)
                                            <svg class="w-2.5 h-2.5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                                        @elseif($balance > 0)
                                            <svg class="w-2.5 h-2.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                                        @endif
                                        <p class="text-[9px] font-black uppercase tracking-widest {{ $balance < 0 ? 'text-rose-500' : ($balance > 0 ? 'text-emerald-600' : 'text-slate-400') }}">
                                            {{ $balance < 0 ? 'vous devez régler' : ($balance > 0 ? 'vous doit' : 'équilibré') }}
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="hidden md:flex flex-col items-end">
                                    <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.2em] mb-1.5">Mon Profil</p>
                                    <div class="w-24 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="w-full h-full bg-blue-600"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="p-16 text-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 mx-auto mb-4 border border-slate-100">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            </div>
                            <p class="text-slate-400 text-sm font-bold uppercase tracking-widest italic">Aucun autre membre détecté.</p>
                        </div>
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
