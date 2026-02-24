<x-app-layout>
    <!-- Sub-Navbar Premium -->
    <div class="glass-nav sticky top-[72px] md:top-[80px] z-40 transition-all duration-300 py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14">
                <!-- Sub-Navbar Links -->
                <div class="flex items-center space-x-2 md:space-x-6">
                    @foreach([
                        ['tab' => 'dashboard', 'label' => 'Tableau de bord', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                        ['tab' => 'members', 'label' => 'Membres', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                        ['tab' => 'expenses', 'label' => 'Dépenses', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['tab' => 'payments', 'label' => 'Paiements', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ] as $item)
                        <a href="{{ route('owner.dashboard', ['tab' => $item['tab']]) }}" 
                           class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold transition-all {{ $tab === $item['tab'] ? 'bg-blue-600 text-white shadow-lg shadow-blue-100 scale-105' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50 hover:scale-105' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" /></svg>
                            <span class="hidden md:block">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>

                <!-- Right Side Info -->
                <div class="hidden md:flex items-center gap-3">
                    <div class="px-3 py-1 bg-red-50 text-red-600 text-[10px] font-black rounded-lg border border-red-100 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 animate-pulse"></span>
                        Owner Access
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 bg-slate-50 min-h-screen relative overflow-hidden pt-24 md:pt-28">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[800px] h-[800px] bg-blue-50 rounded-full blur-[120px] opacity-40 -z-0"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-[600px] h-[600px] bg-indigo-50 rounded-full blur-[120px] opacity-40 -z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            @if(session('success'))
                <div class="mb-8 animate-fade-in">
                    <div class="bg-green-50 border border-green-100 text-green-700 px-6 py-4 rounded-2xl flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            <span class="text-sm font-bold">{{ session('success') }}</span>
                        </div>
                        <button type="button" @click="open = false" class="text-green-400 hover:text-green-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 animate-fade-in">
                    <div class="bg-red-50 border border-red-100 text-red-700 px-6 py-4 rounded-2xl flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                            <span class="text-sm font-bold">{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if($tab === 'dashboard')
                <!-- TAB: STATS & BALANCE -->
                <div class="animate-fade-in space-y-10">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <h1 class="text-4xl font-black text-slate-900 tracking-tight font-heading leading-tight">Bonjour, {{ Auth::user()->name }} 👋</h1>
                            <p class="text-slate-500 font-medium mt-1">Gérez votre colocation <span class="text-blue-600 font-black">{{ $colocation->name }}</span> en un clic.</p>
                        </div>
                    </div>

                    <!-- Enhanced Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="premium-card p-8 group">
                            <div class="flex items-center justify-between mb-6">
                                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 shadow-inner group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <span class="text-[10px] font-black text-blue-600 bg-blue-50 px-2 py-1 rounded-md uppercase tracking-widest">Global</span>
                            </div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Dépenses Totales</p>
                            <div class="text-3xl font-black text-slate-900 font-heading tracking-tight">{{ number_format($totalExpenses, 2) }} DH</div>
                            <div class="mt-4 flex items-center text-[10px] font-bold text-slate-400 italic">
                                Historique global de la coloc
                            </div>
                        </div>

                        <div class="premium-card p-8 group">
                            <div class="flex items-center justify-between mb-6">
                                <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 shadow-inner group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 text-left">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <span class="text-[10px] font-black text-green-600 bg-green-50 px-2 py-1 rounded-md uppercase tracking-widest">Reçu</span>
                            </div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Réglé</p>
                            <div class="text-3xl font-black text-slate-900 font-heading tracking-tight">2,500 DH</div>
                            <div class="w-full bg-slate-100 h-1.5 mt-6 rounded-full overflow-hidden">
                                <div class="bg-green-500 h-full w-[57%] rounded-full shadow-[0_0_10px_rgba(34,197,94,0.3)]"></div>
                            </div>
                        </div>

                        <div class="premium-card p-8 group col-span-1 md:col-span-2 bg-gradient-premium relative overflow-hidden">
                            <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/10 rounded-full blur-3xl pointer-events-none group-hover:scale-125 transition-transform duration-700"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-6 text-white">
                                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-md">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                                    </div>
                                    <span class="text-[10px] font-black bg-white/20 px-2 py-1 rounded-md uppercase tracking-widest">En attente</span>
                                </div>
                                <p class="text-[10px] font-black text-blue-100/70 uppercase tracking-widest mb-1">Reste à percevoir</p>
                                <div class="text-5xl font-black text-white font-heading tracking-tighter">1,869 DH</div>
                                <div class="mt-8 flex items-center gap-4">
                                    <button class="px-5 py-2.5 bg-white text-blue-600 text-[10px] font-black rounded-xl uppercase tracking-widest hover:bg-blue-50 transition-all active:scale-95 shadow-xl shadow-blue-900/20">Lancer un rappel</button>
                                    <p class="text-[10px] font-medium text-blue-100 leading-tight">2 membres doivent encore régler leurs parts.</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Who owes what Premium Cards -->
                    <div class="premium-card overflow-hidden">
                        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-slate-50/50">
                            <div>
                                <h3 class="text-xl font-black text-slate-900 font-heading">Situation des membres</h3>
                                <p class="text-slate-500 text-xs font-medium mt-1">Suivez les versements de vos colocs en temps réel.</p>
                            </div>
                            <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Live Status</span>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left bg-slate-50/30">
                                        <th class="py-5 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">Colocataire</th>
                                        <th class="py-5 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">Progression</th>
                                        <th class="py-5 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">Dette Actuelle</th>
                                        <th class="py-5 px-8 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach($colocation->members as $member)
                                        @php if($member->user_id === $colocation->user_id) continue; @endphp
                                        <tr class="hover:bg-slate-50/80 transition-all group">
                                            <td class="py-6 px-8 flex items-center gap-4">
                                                <div class="w-12 h-12 bg-white rounded-xl border border-slate-200 flex items-center justify-center font-black text-slate-800 shadow-sm group-hover:scale-105 transition-transform duration-300">
                                                    {{ substr($member->user->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <span class="block font-black text-slate-900 text-base leading-tight">{{ $member->user->name }}</span>
                                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Membre actif</span>
                                                </div>
                                            </td>
                                            <td class="py-6 px-8">
                                                <div class="flex items-center gap-3">
                                                    <div class="flex-1 bg-slate-100 h-2 rounded-full w-24 overflow-hidden border border-slate-200">
                                                        <div class="bg-blue-600 h-full w-[80%] rounded-full shadow-[0_0_8px_rgba(37,99,235,0.2)]"></div>
                                                    </div>
                                                    <span class="text-xs font-black text-slate-800">80%</span>
                                                </div>
                                            </td>
                                            <td class="py-6 px-8">
                                                <span class="text-lg font-black text-red-600 font-heading tracking-tight">- 420.00 DH</span>
                                            </td>
                                            <td class="py-6 px-8 text-right">
                                                <button class="btn-premium px-4 py-2 inline-flex items-center text-[10px] font-black uppercase tracking-widest bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-100">
                                                    Rappel WhatsApp
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Danger Zone Premium -->
                    <div class="premium-card p-10 border-red-50 flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden group">
                        <div class="absolute inset-0 bg-red-50/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10 text-center md:text-left">
                            <h3 class="text-xl font-black text-slate-900 font-heading">Zone de danger</h3>
                            <p class="text-slate-500 font-medium mt-1 max-w-md text-sm leading-relaxed">Attention, supprimer la colocation supprimera définitivement l'historique et les accès des membres.</p>
                        </div>
                        <button type="button" class="relative z-10 btn-premium px-8 py-4 bg-white text-red-600 border border-red-100 hover:bg-red-600 hover:text-white hover:border-red-600 shadow-xl shadow-red-100">
                            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            Supprimer la Colocation
                        </button>
                    </div>
                </div>


            @elseif($tab === 'members')
                <!-- TAB: MEMBERS MANAGEMENT (ENHANCED) -->
                <div class="animate-fade-in space-y-12">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tight font-outfit">Ma Tribu</h2>
                            <p class="text-slate-500 font-medium">Invitez et gérez les membres de votre colocation.</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                        <div class="lg:col-span-5">
                            <div class="bg-white p-12 rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white sticky top-36">
                                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-8 border border-blue-100">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                </div>
                                <h3 class="text-2xl font-black text-slate-900 mb-2 lowercase first-letter:uppercase">Ajouter un membre</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-10">Rechercher par nom ou email</p>
                                
                                <form action="{{ route('owner.dashboard') }}" method="GET" class="space-y-6 mb-10">
                                    <input type="hidden" name="tab" value="members">
                                    <div class="relative group">
                                        <input type="text" name="search" value="{{ $search }}" placeholder="Ex: Sara Lmkadem" class="w-full px-8 py-5 bg-slate-50 border-transparent rounded-[1.5rem] text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all font-medium text-lg">
                                        <button type="submit" class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 hover:text-blue-600 transition-colors">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                        </button>
                                    </div>
                                    @if($search)
                                        <div class="flex items-center justify-between px-4">
                                            <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Résultats pour "{{ $search }}"</p>
                                            <a href="{{ route('owner.dashboard', ['tab' => 'members']) }}" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 underline">Effacer</a>
                                        </div>
                                    @endif
                                </form>

                                <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                                    @forelse($potentialMembers as $pMember)
                                        <div class="flex items-center justify-between p-5 bg-slate-50/50 rounded-3xl border border-slate-100 hover:bg-white hover:border-blue-100 transition-all group">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center font-black text-slate-800 text-lg">
                                                    {{ substr($pMember->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="text-sm font-black text-slate-900 leading-tight">{{ $pMember->name }}</p>
                                                    <p class="text-[10px] text-slate-400 font-medium truncate max-w-[150px]">{{ $pMember->email }}</p>
                                                </div>
                                            </div>
                                            <form action="{{ route('colocations.invite') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="email" value="{{ $pMember->email }}">
                                                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-[10px] font-black rounded-xl uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-blue-100 active:scale-95">
                                                    Inviter
                                                </button>
                                            </form>
                                        </div>
                                    @empty
                                        <div class="text-center py-10 px-6 border-2 border-dashed border-slate-100 rounded-[2rem]">
                                            <p class="text-slate-300 font-black uppercase text-[10px] tracking-widest">
                                                {{ $search ? 'Aucun utilisateur trouvé' : 'Recherchez un utilisateur' }}
                                            </p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-7">
                            <div class="bg-white p-12 rounded-[3rem] shadow-xl shadow-slate-200/50 border border-white">
                                <h3 class="text-2xl font-black text-slate-900 mb-10">Activités et Membres</h3>
                                <div class="space-y-6">
                                    @foreach($colocation->members as $member)
                                        <div class="flex items-center justify-between p-6 bg-slate-50/50 rounded-[2rem] border border-slate-100 group transition-all hover:bg-white hover:shadow-xl hover:shadow-slate-200/30">
                                            <div class="flex items-center gap-5">
                                                <div class="w-14 h-14 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center font-black text-slate-800 text-xl overflow-hidden relative">
                                                    {{ substr($member->user->name, 0, 1) }}
                                                    <div class="absolute bottom-0 w-full h-1 bg-blue-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                                </div>
                                                <div>
                                                    <p class="text-lg font-black text-slate-900">{{ $member->user->name }}</p>
                                                    <p class="text-[9px] text-slate-400 uppercase tracking-widest font-black">Rejoint le {{ $member->created_at->format('d M, Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-4">
                                                @if($member->user_id === $colocation->user_id)
                                                    <span class="px-3 py-1 bg-blue-600 text-white text-[9px] font-black rounded-full shadow-lg shadow-blue-100 uppercase tracking-widest">MOI</span>
                                                @else
                                                    <div class="flex items-center gap-3">
                                                        <span class="text-[9px] font-black text-green-600 bg-green-50 px-3 py-1 rounded-full border border-green-100">Actif</span>
                                                        <button class="w-10 h-10 flex items-center justify-center text-rose-300 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all border border-transparent hover:border-rose-100">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                    @forelse($pendingInvitations as $invitation)
                                        <div class="flex items-center justify-between p-6 bg-white rounded-[2rem] border border-dashed border-slate-200 group hover:border-blue-200 transition-all">
                                            <div class="flex items-center gap-5">
                                                <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center font-black text-slate-300 italic border border-slate-100">?</div>
                                                <div>
                                                    <p class="text-lg font-black text-slate-900 font-heading tracking-tight lowercase first-letter:uppercase truncate max-w-[200px]">{{ $invitation->email }}</p>
                                                    <p class="text-[9px] text-slate-400 uppercase tracking-widest font-black flex items-center gap-2">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-400 animate-pulse"></span>
                                                        Invitation en attente
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <button class="px-5 py-2.5 text-[9px] font-black text-slate-400 hover:text-slate-600 bg-slate-50 rounded-xl border border-slate-100 transition-all uppercase tracking-widest active:scale-95">Relancer</button>
                                                <button class="px-5 py-2.5 text-[9px] font-black text-rose-500 hover:text-rose-700 bg-rose-50/50 rounded-xl border border-rose-100 transition-all uppercase tracking-widest active:scale-95">Annuler</button>
                                            </div>
                                        </div>
                                    @empty
                                        <!-- No pending invitations -->
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            @elseif($tab === 'expenses')
                <!-- TAB: EXPENSES (SIMPLE O NADI OWNER VIEW) -->
                <div class="animate-fade-in space-y-10">
                     <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-slate-100 pb-8">
                        <div>
                            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight font-heading">Gestion des Frais</h2>
                            <p class="text-slate-500 font-medium mt-1">Gérez les dépenses de la colocation en toute simplicité.</p>
                        </div>
                        <div class="flex items-center gap-4 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div class="pr-4">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Budget estimé</p>
                                <p class="text-base font-black text-slate-800 mt-1">12,000 DH</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                        <!-- Add Expense Form (Clean Style) -->
                        <div class="lg:col-span-5">
                            <div class="bg-white p-10 rounded-3xl shadow-xl shadow-slate-100 border border-slate-50 sticky top-36">
                                <h3 class="text-xl font-black text-slate-900 mb-6">Nouveau Frais</h3>
                                
                                <form action="#" method="POST" class="space-y-5">
                                    <div class="space-y-1.5">
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Désignation</label>
                                        <input type="text" placeholder="Ex: Réparation Plomberie" class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-800 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500/20 transition-all font-bold">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-1.5">
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Montant (DH)</label>
                                            <input type="number" placeholder="0.00" class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500/20 font-black text-lg">
                                        </div>
                                        <div class="space-y-1.5">
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Catégorie</label>
                                            <select class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500/20 font-bold appearance-none cursor-pointer">
                                                <option>Loyer</option>
                                                <option>Eau/Élec</option>
                                                <option>Internet</option>
                                                <option>Autre</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 p-4 bg-blue-50/30 rounded-2xl border border-blue-50">
                                        <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500/20">
                                        <p class="text-[10px] font-bold text-blue-600 uppercase tracking-tight">Dividé équitablement</p>
                                    </div>
                                    <button type="button" class="w-full py-5 bg-slate-900 text-white font-black rounded-2xl hover:bg-blue-600 transition-all shadow-lg active:scale-[0.98] text-sm uppercase tracking-widest">
                                        Enregistrer
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Expenses List (Refined) -->
                        <div class="lg:col-span-7">
                            <div class="bg-white rounded-3xl shadow-xl shadow-slate-100 border border-slate-50 overflow-hidden">
                                <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between">
                                    <h3 class="text-lg font-black text-slate-900">Journal des Dépenses</h3>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Février 2026</span>
                                </div>
                                
                                <div class="divide-y divide-slate-50">
                                    @php
                                        $staticExpenses = [
                                            ['title' => 'Loyer Mensuel', 'amount' => 5000.00, 'date' => '01 Fév', 'cat' => 'Fixe', 'payer' => 'Admin'],
                                            ['title' => 'Internet Fiber', 'amount' => 349.00, 'date' => '05 Fév', 'cat' => 'Internet', 'payer' => 'Admin'],
                                            ['title' => 'Réparation Chauffe-eau', 'amount' => 450.00, 'date' => '12 Fév', 'cat' => 'Maintenance', 'payer' => 'Moi'],
                                            ['title' => 'Achat Détergents', 'amount' => 120.00, 'date' => '15 Fév', 'cat' => 'Divers', 'payer' => 'Sara'],
                                        ];
                                    @endphp

                                    @foreach($staticExpenses as $exp)
                                        <div class="px-10 py-6 flex items-center justify-between group hover:bg-slate-50/50 transition-colors">
                                            <div class="flex items-center gap-6">
                                                <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center text-blue-600 font-black text-lg group-hover:bg-blue-600 group-hover:text-white transition-all">
                                                    {{ substr($exp['title'], 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="text-base font-black text-slate-800">{{ $exp['title'] }}</p>
                                                    <div class="flex items-center gap-2 mt-1">
                                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $exp['date'] }}</span>
                                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $exp['cat'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-xl font-black text-slate-900 tracking-tight">{{ number_format($exp['amount'], 2) }} DH</p>
                                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Par {{ $exp['payer'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="p-8 bg-slate-50 flex items-center justify-between">
                                    <div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 leading-none">Total mensuel</p>
                                        <p class="text-2xl font-black text-slate-900 tracking-tight">5,919.00 <span class="text-xs font-medium text-slate-400 ml-0.5">DH</span></p>
                                    </div>
                                    <button class="px-5 py-2.5 bg-white border border-slate-200 hover:border-slate-300 text-slate-600 text-[10px] font-black rounded-xl uppercase tracking-widest transition-all">
                                        Exporter PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif($tab === 'payments')
                <!-- TAB: PAYMENTS (SIMPLE O NADI - PREMIUM & CLEAN) -->
                <div class="animate-fade-in space-y-10">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                        <div class="max-w-xl">
                            <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight font-heading">Trésorerie & Encaissements</h2>
                            <p class="text-slate-500 font-medium mt-1">Validez les paiements reçus et contrôlez la balance de chaque membre.</p>
                        </div>
                        <div class="bg-slate-900 px-8 py-5 rounded-3xl text-white shadow-xl shadow-slate-200">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest opacity-80 leading-none">Balance Disponible</p>
                            <p class="text-3xl font-black mt-1.5 tracking-tight">14,250.00 <span class="text-sm font-medium opacity-40 ml-0.5">DH</span></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                        <!-- Simplified Validation Form -->
                        <div class="lg:col-span-12 xl:col-span-5">
                            <div class="bg-white p-10 rounded-3xl shadow-xl shadow-slate-100 border border-slate-50">
                                <h3 class="text-xl font-black text-slate-900 mb-8 lowercase first-letter:uppercase">Valider un encaissement</h3>
                                
                                <form action="#" method="POST" class="space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div class="space-y-1.5">
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Colocataire</label>
                                            <select class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 focus:bg-white focus:ring-2 focus:ring-green-500/10 focus:border-green-500/20 font-bold transition-all">
                                                @foreach($colocation->members as $member)
                                                    @if($member->user_id !== $colocation->user_id) <option>{{ $member->user->name }}</option> @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="space-y-1.5">
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Méthode</label>
                                            <select class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl text-slate-900 focus:bg-white focus:ring-2 focus:ring-green-500/10 focus:border-green-500/20 font-bold transition-all">
                                                <option>Espèces</option>
                                                <option>Virement</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Dettes à solder</label>
                                        <div class="space-y-3">
                                            <label class="flex items-center p-5 bg-slate-50 rounded-2xl border border-transparent cursor-pointer group hover:bg-white hover:border-green-500/20 hover:shadow-lg transition-all">
                                                <input type="checkbox" class="w-5 h-5 rounded-lg border-slate-300 text-green-600 focus:ring-green-500/20 mr-4">
                                                <div class="flex-1 flex justify-between items-center">
                                                    <div>
                                                        <p class="text-sm font-black text-slate-900">Loyer Mars</p>
                                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Dû le 05 Mars</p>
                                                    </div>
                                                    <p class="text-base font-black text-green-600">1,166 DH</p>
                                                </div>
                                            </label>

                                            <label class="flex items-center p-5 bg-slate-50 rounded-2xl border border-transparent cursor-pointer group hover:bg-white hover:border-green-500/20 hover:shadow-lg transition-all">
                                                <input type="checkbox" class="w-5 h-5 rounded-lg border-slate-300 text-green-600 focus:ring-green-500/20 mr-4">
                                                <div class="flex-1 flex justify-between items-center">
                                                    <div>
                                                        <p class="text-sm font-black text-slate-900">Internet / Divers</p>
                                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Dû Aujourd'hui</p>
                                                    </div>
                                                    <p class="text-base font-black text-green-600">320 DH</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <button type="button" class="w-full py-5 bg-green-600 text-white font-black rounded-2xl hover:bg-green-700 transition-all shadow-xl shadow-green-100 active:scale-95 text-sm uppercase tracking-widest flex items-center justify-center gap-3">
                                        Confirmer le paiement
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Recent Transactions (Refined List) -->
                        <div class="lg:col-span-12 xl:col-span-7">
                            <div class="bg-white rounded-3xl shadow-xl shadow-slate-100 border border-slate-50 overflow-hidden">
                                <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between">
                                    <h3 class="text-lg font-black text-slate-900">Mouvements récents</h3>
                                    <button class="text-[10px] font-bold text-blue-600 uppercase tracking-widest hover:underline">Voir tout</button>
                                </div>
                                
                                <div class="divide-y divide-slate-50">
                                    @php
                                        $staticPayments = [
                                            ['name' => 'Yassine', 'amount' => 1166, 'title' => 'Loyer Mars', 'date' => 'Il y a 2h', 'method' => 'Virement'],
                                            ['name' => 'Sara', 'amount' => 320, 'title' => 'Internet', 'date' => 'Hier', 'method' => 'Espèces'],
                                            ['name' => 'Amine', 'amount' => 1166, 'title' => 'Loyer Mars', 'date' => '23 Fév', 'method' => 'Virement'],
                                            ['name' => 'Sara', 'amount' => 1166, 'title' => 'Loyer Fév', 'date' => '05 Fév', 'method' => 'Espèces'],
                                        ];
                                    @endphp

                                    @foreach($staticPayments as $pay)
                                        <div class="px-10 py-6 flex items-center justify-between group hover:bg-slate-50/50 transition-colors">
                                            <div class="flex items-center gap-6">
                                                <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center font-bold">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                                </div>
                                                <div>
                                                    <p class="text-base font-black text-slate-800">{{ $pay['name'] }} <span class="text-slate-400 font-bold ml-1">•</span> <span class="text-slate-500 font-medium ml-1">{{ $pay['title'] }}</span></p>
                                                    <div class="flex items-center gap-2 mt-1">
                                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $pay['date'] }}</span>
                                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $pay['method'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-xl font-black text-green-600 tracking-tight">+{{ number_format($pay['amount'], 2) }} DH</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="p-10 bg-slate-50">
                                    <div class="p-8 bg-white rounded-2xl border border-slate-200 flex flex-col md:flex-row items-center justify-between gap-6">
                                        <div class="text-center md:text-left">
                                            <h4 class="text-lg font-black text-slate-900">Rapport Financier 📊</h4>
                                            <p class="text-xs text-slate-500 font-medium mt-1">Générez un récapitulatif complet des comptes.</p>
                                        </div>
                                        <button class="px-8 py-4 bg-slate-900 text-white font-black rounded-xl text-[10px] uppercase tracking-widest hover:bg-slate-800 transition-all active:scale-95 shadow-lg">
                                            Générer le rapport PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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

        /* Modern scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(241, 245, 249, 0.5);
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</x-app-layout>
