<x-app-layout>
    <div class="bg-white border-b border-slate-100 sticky top-16 z-40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Sub-Navbar Links -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('owner.dashboard', ['tab' => 'dashboard']) }}" 
                       class="relative py-5 text-sm font-black transition-all {{ $tab === 'dashboard' ? 'text-blue-600' : 'text-slate-500 hover:text-slate-800' }}">
                        Tableau de bord
                        @if($tab === 'dashboard') <span class="absolute bottom-0 left-0 w-full h-1 bg-blue-600 rounded-t-full"></span> @endif
                    </a>
                    <a href="{{ route('owner.dashboard', ['tab' => 'members']) }}" 
                       class="relative py-5 text-sm font-black transition-all {{ $tab === 'members' ? 'text-indigo-600' : 'text-slate-500 hover:text-slate-800' }}">
                        Membres
                        @if($tab === 'members') <span class="absolute bottom-0 left-0 w-full h-1 bg-indigo-600 rounded-t-full"></span> @endif
                    </a>
                    <a href="{{ route('owner.dashboard', ['tab' => 'expenses']) }}" 
                       class="relative py-5 text-sm font-black transition-all {{ $tab === 'expenses' ? 'text-rose-600' : 'text-slate-500 hover:text-slate-800' }}">
                        Dépenses
                        @if($tab === 'expenses') <span class="absolute bottom-0 left-0 w-full h-1 bg-rose-600 rounded-t-full"></span> @endif
                    </a>
                    <a href="{{ route('owner.dashboard', ['tab' => 'payments']) }}" 
                       class="relative py-5 text-sm font-black transition-all {{ $tab === 'payments' ? 'text-green-600' : 'text-slate-500 hover:text-slate-800' }}">
                        Paiements
                        @if($tab === 'payments') <span class="absolute bottom-0 left-0 w-full h-1 bg-green-600 rounded-t-full"></span> @endif
                    </a>
                    <a href="{{ route('owner.dashboard', ['tab' => 'chat']) }}" 
                       class="relative py-5 text-sm font-black transition-all {{ $tab === 'chat' ? 'text-indigo-600' : 'text-slate-500 hover:text-slate-800' }}">
                        Group Chat
                        <span class="ml-2 px-1.5 py-0.5 bg-green-100 text-green-600 text-[8px] rounded-md animate-pulse">LIVE</span>
                        @if($tab === 'chat') <span class="absolute bottom-0 left-0 w-full h-1 bg-indigo-600 rounded-t-full"></span> @endif
                    </a>
                </div>

                <!-- Right Side Info -->
                <div class="hidden md:flex items-center gap-4">
                    <span class="px-3 py-1 bg-rose-50 text-rose-600 text-[10px] font-black rounded-full border border-rose-100 uppercase tracking-widest">Propriétaire</span>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 bg-slate-50 min-h-screen relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[800px] h-[800px] bg-blue-50 rounded-full blur-3xl opacity-30 -z-0"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-[600px] h-[600px] bg-indigo-50 rounded-full blur-3xl opacity-30 -z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            @if($tab === 'dashboard')
                <!-- TAB: STATS & BALANCE (ENHANCED) -->
                <div class="animate-fade-in space-y-10">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Bonjour, {{ Auth::user()->name }} 👋</h1>
                            <p class="text-slate-500 font-medium mt-1">Voici le pilotage de votre colocation <span class="text-blue-600 font-black">{{ $colocation->name }}</span>.</p>
                        </div>
                    </div>

                    <!-- Enhanced Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-white group hover:scale-[1.02] transition-transform">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-10 h-10 bg-rose-100 rounded-xl flex items-center justify-center text-rose-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Dépenses Totales</p>
                            </div>
                            <div class="text-3xl font-black text-slate-900 font-outfit">4,369 DH</div>
                            <div class="mt-4 flex items-center text-[10px] font-bold text-rose-600 italic">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                                +12% ce mois
                            </div>
                        </div>

                        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-white group hover:scale-[1.02] transition-transform text-left">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center text-green-600 text-left">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Collecté</p>
                            </div>
                            <div class="text-3xl font-black text-slate-900 font-outfit">2,500 DH</div>
                            <div class="w-full bg-slate-100 h-1.5 mt-6 rounded-full overflow-hidden">
                                <div class="bg-green-500 h-full w-[57%]"></div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-blue-600 to-indigo-800 p-8 rounded-[2.5rem] shadow-2xl shadow-blue-200 lg:col-span-2 text-white relative overflow-hidden group">
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-700"></div>
                            <div class="relative z-10">
                                <p class="text-[10px] font-black text-blue-100 uppercase tracking-widest mb-4 opacity-80">Reste à percevoir (Balance)</p>
                                <div class="text-5xl font-black font-outfit">1,869 DH</div>
                                <div class="mt-8 flex items-center gap-4">
                                    <button class="px-6 py-3 bg-white/10 backdrop-blur-md rounded-xl text-[10px] font-black uppercase hover:bg-white/20 transition-all border border-white/20">Lancer un rappel</button>
                                    <span class="text-[10px] font-medium text-blue-100 opacity-60">2 membres n'ont pas encore réglé.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Who owes what Premium Cards -->
                    <div class="bg-white rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white overflow-hidden">
                        <div class="p-10 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-slate-50/50">
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">Situation des membres</h3>
                                <p class="text-slate-500 text-sm font-medium mt-1">Suivez les versements de votre tribu en temps réel.</p>
                            </div>
                            <div class="flex items-center gap-2 px-6 py-3 bg-white rounded-2xl shadow-sm border border-slate-100">
                                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest font-outfit">Live Tracking</span>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left">
                                        <th class="py-6 px-10 text-[10px] font-black text-slate-400 uppercase tracking-widest">Colocataire</th>
                                        <th class="py-6 px-10 text-[10px] font-black text-slate-400 uppercase tracking-widest">Progression</th>
                                        <th class="py-6 px-10 text-[10px] font-black text-slate-400 uppercase tracking-widest text-left">Dette</th>
                                        <th class="py-6 px-10 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach($colocation->members as $member)
                                        @php if($member->user_id === $colocation->user_id) continue; @endphp
                                        <tr class="hover:bg-slate-50/80 transition-all group">
                                            <td class="py-8 px-10 flex items-center gap-4">
                                                <div class="w-14 h-14 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center font-black text-slate-800 text-xl border border-slate-200 uppercase shadow-sm group-hover:scale-105 transition-transform">
                                                    {{ substr($member->user->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <span class="block font-black text-slate-900 text-lg">{{ $member->user->name }}</span>
                                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">S'est joint il y a 3 mois</span>
                                                </div>
                                            </td>
                                            <td class="py-8 px-10">
                                                <div class="flex items-center gap-4">
                                                    <div class="flex-1 bg-slate-100 h-2 rounded-full w-24 overflow-hidden border border-slate-200">
                                                        <div class="bg-blue-600 h-full w-[80%] rounded-full shadow-[0_0_10px_rgba(37,99,235,0.3)]"></div>
                                                    </div>
                                                    <span class="text-xs font-black text-slate-800">80%</span>
                                                </div>
                                            </td>
                                            <td class="py-8 px-10 text-left">
                                                <span class="text-xl font-black text-rose-600 font-outfit">- 420.00 DH</span>
                                            </td>
                                            <td class="py-8 px-10 text-right">
                                                <button class="px-6 py-3 text-[10px] font-black uppercase text-blue-600 hover:bg-white hover:shadow-md rounded-xl border border-transparent hover:border-blue-100 transition-all tracking-widest">WhatsApp Rappel</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Danger Zone Premium -->
                    <div class="bg-white rounded-[3rem] p-12 border border-rose-100 flex flex-col md:flex-row items-center justify-between gap-10 relative overflow-hidden group">
                        <div class="absolute inset-0 bg-rose-50/30 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative z-10 text-center md:text-left">
                            <h3 class="text-2xl font-black text-slate-900">Propriétaire : Zone de danger</h3>
                            <p class="text-slate-500 font-medium mt-2 max-w-md">La suppression de la colocation entraînera l'archivage définitif de tous les membres et de l'historique financier.</p>
                        </div>
                        <button type="button" class="relative z-10 px-10 py-5 bg-white text-rose-600 font-black rounded-[1.5rem] border border-rose-200 hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all shadow-2xl shadow-rose-100 flex items-center gap-4 active:scale-95 group/btn">
                            <svg class="w-6 h-6 group-hover/btn:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
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
                                <h3 class="text-2xl font-black text-slate-900 mb-2">Ajouter un Membre</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-10">Envoyez une invitation par email</p>
                                
                                <form action="#" method="POST" class="space-y-8">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Adresse Email</label>
                                        <div class="relative group">
                                            <input type="email" placeholder="coloc@easycoloc.com" class="w-full px-8 py-5 bg-slate-50 border-transparent rounded-[1.5rem] text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all font-medium text-lg">
                                            <div class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" /></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="w-full py-6 bg-blue-600 text-white font-black rounded-[1.5rem] hover:bg-blue-700 transition shadow-2xl shadow-blue-200 transform active:scale-[0.98] text-lg">
                                        Envoyer l'invitation ✨
                                    </button>
                                </form>
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

                                    <!-- Pending Placeholder -->
                                    <div class="flex items-center justify-between p-6 bg-white rounded-[2rem] border-2 border-dashed border-slate-100 group opacity-60">
                                        <div class="flex items-center gap-5">
                                            <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center font-black text-slate-300 italic">?</div>
                                            <div>
                                                <p class="text-lg font-black text-slate-400 font-outfit tracking-tight">Sara.l@gmail.com</p>
                                                <p class="text-[9px] text-slate-300 uppercase tracking-widest font-black">Invitation en attente</p>
                                            </div>
                                        </div>
                                        <button class="px-6 py-3 text-[10px] font-black text-rose-500 hover:text-rose-700 bg-rose-50/50 rounded-xl border border-rose-100 transition-all uppercase tracking-widest">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif($tab === 'expenses')
                <!-- TAB: EXPENSES (ENHANCED) -->
                <div class="animate-fade-in space-y-12">
                     <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tight font-outfit">Registre des Dépenses</h2>
                            <p class="text-slate-500 font-medium mt-1">Gérez le budget de la colocation à la virgule près.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                        <div class="lg:col-span-5">
                            <div class="bg-white p-12 rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white sticky top-36">
                                <div class="w-16 h-16 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600 mb-8 border border-rose-100">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <h3 class="text-2xl font-black text-slate-900 mb-2">Nouvelle Charge</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-10">Une dépense partagée entre tous.</p>

                                <form action="#" method="POST" class="space-y-8">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Titre de la dépense</label>
                                        <input type="text" placeholder="Facture Internet, Courses..." class="w-full px-8 py-5 bg-slate-50 border-transparent rounded-[1.5rem] text-slate-900 focus:bg-white focus:ring-4 focus:ring-rose-100 focus:border-rose-700 focus:ring-opacity-10 transition-all font-medium">
                                    </div>
                                    <div class="grid grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Montant (DH)</label>
                                            <input type="number" placeholder="0.00" class="w-full px-8 py-5 bg-slate-50 border-transparent rounded-[1.5rem] text-slate-900 focus:bg-white focus:ring-4 focus:ring-rose-100 font-black text-2xl">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Catégorie</label>
                                            <select class="w-full px-8 py-5 bg-slate-50 border-transparent rounded-[1.5rem] text-slate-900 focus:bg-white focus:ring-4 focus:ring-rose-100 font-bold transition-all appearance-none cursor-pointer">
                                                <option>Alimentation</option>
                                                <option>Factures</option>
                                                <option>Loyer</option>
                                                <option>Divers</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="button" class="w-full py-6 bg-rose-600 text-white font-black rounded-[1.5rem] hover:bg-rose-700 transition shadow-2xl shadow-rose-200 transform active:scale-[0.98] text-lg">
                                        Enregistrer ✨
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="lg:col-span-7">
                            <div class="bg-white p-12 rounded-[3rem] shadow-xl shadow-slate-200/50 border border-white">
                                <div class="flex items-center justify-between mb-10">
                                    <h3 class="text-2xl font-black text-slate-900">Charges du mois</h3>
                                    <span class="text-[10px] font-black text-slate-400 uppercase">Février 2026</span>
                                </div>
                                <div class="space-y-4">
                                    <!-- Expense Item -->
                                    <div class="p-8 bg-slate-50/50 rounded-[2rem] border border-slate-100 flex items-center justify-between group hover:bg-white hover:shadow-xl hover:shadow-slate-200/30 transition-all">
                                        <div class="flex items-center gap-6">
                                            <div class="w-16 h-16 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                                <svg class="w-8 h-8 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                            </div>
                                            <div>
                                                <p class="text-lg font-black text-slate-900">Loyers Total</p>
                                                <div class="flex items-center gap-3 mt-1">
                                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Aujourd'hui</span>
                                                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                                    <span class="px-2 py-0.5 bg-rose-50 text-rose-500 text-[8px] font-black rounded-md uppercase">Propriétaire</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-2xl font-black text-slate-900 font-outfit tracking-tighter">3,500.00 DH</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Payé par : MOI</p>
                                        </div>
                                    </div>

                                    <div class="p-8 bg-white rounded-[2rem] border border-slate-100 flex items-center justify-between group hover:shadow-xl transition-all">
                                        <div class="flex items-center gap-6">
                                            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                            </div>
                                            <div>
                                                <p class="text-lg font-black text-slate-900">Internet Fibre</p>
                                                <div class="flex items-center gap-3 mt-1">
                                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">23 Fév</span>
                                                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                                    <span class="px-2 py-0.5 bg-indigo-50 text-indigo-500 text-[8px] font-black rounded-md uppercase tracking-tight">Virement</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-2xl font-black text-slate-900 font-outfit tracking-tighter">349.00 DH</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Payé par : MOI</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif($tab === 'payments')
                <!-- TAB: PAYMENTS (ENHANCED) -->
                <div class="animate-fade-in space-y-12">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tight font-outfit text-left">Validation des règlements</h2>
                            <p class="text-slate-500 font-medium mt-1 text-left">Confirmez la réception du cash ou des virements des colocs.</p>
                        </div>
                        <div class="px-8 py-4 bg-green-50 border border-green-100 rounded-3xl flex items-center gap-4 shadow-sm shadow-green-100">
                             <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                             </div>
                             <div>
                                <p class="text-[10px] font-black text-green-700 uppercase tracking-widest">Trésorerie Actuelle</p>
                                <p class="text-xl font-black text-slate-900">2,500.00 DH</p>
                             </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                        <div class="lg:col-span-5">
                            <div class="bg-white p-12 rounded-[3.5rem] shadow-2xl shadow-slate-200/50 border border-white">
                                <h3 class="text-2xl font-black text-slate-900 mb-2 text-left">Nouveau Encaissement</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-10 text-left">Valider un règlement membre</p>
                                
                                <form action="#" method="POST" class="space-y-8">
                                    <div class="grid grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-2 text-left">Colocataire</label>
                                            <div class="relative">
                                                <select class="w-full px-8 py-5 bg-slate-50 border-transparent rounded-3xl text-slate-900 focus:bg-white focus:ring-4 focus:ring-green-100 font-bold appearance-none cursor-pointer">
                                                    @foreach($colocation->members as $member)
                                                        @if($member->user_id !== $colocation->user_id) <option>{{ $member->user->name }}</option> @endif
                                                    @endforeach
                                                </select>
                                                <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-2 text-left text-left">Mode Payment</label>
                                            <select class="w-full px-8 py-5 bg-slate-50 border-transparent rounded-3xl text-slate-900 focus:bg-white focus:ring-4 focus:ring-green-100 font-bold transition-all appearance-none cursor-pointer">
                                                <option>Espèces</option>
                                                <option>Virement</option>
                                                <option>Application</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="p-8 bg-slate-50/50 rounded-[2.5rem] border border-slate-100 space-y-6">
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-2 text-left">Sélectionner les frais réglés</label>
                                        <div class="space-y-3 pb-2">
                                            <label class="flex items-center p-5 bg-white rounded-3xl border border-slate-200 cursor-pointer group hover:border-green-400 transition-all shadow-sm">
                                                <input type="checkbox" class="w-6 h-6 rounded-[0.5rem] border-slate-300 text-green-600 focus:ring-green-500 mr-4">
                                                <div class="flex-1 text-left">
                                                    <p class="text-sm font-black text-slate-900">Loyer Mars</p>
                                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight font-outfit">Quote-part : 1,166 DH</p>
                                                </div>
                                            </label>
                                            <label class="flex items-center p-5 bg-white rounded-3xl border border-slate-200 cursor-pointer group hover:border-green-400 transition-all shadow-sm">
                                                <input type="checkbox" class="w-6 h-6 rounded-[0.5rem] border-slate-300 text-green-600 focus:ring-green-500 mr-4">
                                                <div class="flex-1 text-left">
                                                    <p class="text-sm font-black text-slate-900">Internet / Divers</p>
                                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight font-outfit">Quote-part : 349 DH</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <button type="button" class="w-full py-6 bg-green-600 text-white font-black rounded-[2rem] hover:bg-green-700 transition shadow-2xl shadow-green-200 transform active:scale-[0.98] text-lg">
                                        Confirmer le règlement ✨
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="lg:col-span-7 space-y-8">
                             <div class="bg-white p-12 rounded-[3.5rem] shadow-xl shadow-slate-200/50 border border-white">
                                <h3 class="text-2xl font-black text-slate-900 mb-10 text-left">Derniers Encaissements</h3>
                                <div class="space-y-8">
                                    <div class="flex items-start gap-5 relative group">
                                        <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center flex-shrink-0 text-green-600 border border-green-100 group-hover:bg-green-600 group-hover:text-white transition-all shadow-sm">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        </div>
                                        <div class="flex-1 text-left">
                                            <div class="flex justify-between items-start">
                                                <p class="text-lg font-bold text-slate-600 leading-tight">
                                                    <span class="text-slate-900 font-black">Yassine</span> a réglé pour <span class="text-slate-900 font-black">Loyer Mars</span>
                                                </p>
                                                <span class="text-xl font-black text-green-600 font-outfit">+1,166 DH</span>
                                            </div>
                                            <div class="flex items-center gap-3 mt-2">
                                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Hière • 21:30</span>
                                                <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                                <span class="px-2 py-0.5 bg-slate-50 text-[8px] font-black text-slate-500 rounded border border-slate-100 uppercase tracking-widest">Virement Bancaire</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="h-[1px] bg-slate-50 w-full"></div>

                                    <div class="flex items-center gap-4 py-4 px-6 bg-slate-50 rounded-3xl border border-dashed border-slate-200 opacity-60">
                                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </div>
                                        <p class="text-xs font-bold text-slate-400 italic">En attente de nouveaux versements...</p>
                                    </div>
                                </div>
                             </div>

                             <div class="bg-gradient-to-br from-green-600 to-emerald-800 p-10 rounded-[3rem] text-white shadow-2xl shadow-green-100 relative overflow-hidden group">
                                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-1000"></div>
                                <div class="flex items-center gap-6 relative z-10">
                                    <div class="w-16 h-16 bg-white/10 backdrop-blur-xl rounded-2xl flex items-center justify-center border border-white/20">
                                        <svg class="w-10 h-10 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-black text-green-100 uppercase tracking-widest opacity-80 leading-none mb-2">Confiance Globally</p>
                                        <p class="text-2xl font-black tracking-tight font-outfit">85% des charges confirmées</p>
                                        <p class="text-[10px] mt-2 font-medium text-green-50 opacity-60 italic">Bravo boss! Votre colocation est saine financièrement.</p>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>

            @elseif($tab === 'chat')
                <!-- TAB: GROUP CHAT (PREMIUM OWNER VERSION) -->
                <div class="animate-fade-in bg-white rounded-[3rem] shadow-2xl border border-white overflow-hidden h-[750px] flex flex-col md:flex-row">
                    <!-- Sidebar Membres (Desktop) -->
                    <div class="hidden lg:flex w-72 border-r border-slate-50 flex-col bg-slate-50/20">
                        <div class="p-8 border-b border-slate-50">
                            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest">En ligne (3)</h4>
                        </div>
                        <div class="flex-1 overflow-y-auto p-4 space-y-2">
                             @foreach($colocation->members as $member)
                                <div class="flex items-center gap-3 p-3 rounded-2xl hover:bg-white hover:shadow-sm transition-all cursor-pointer group relative">
                                    <div class="relative">
                                        <div class="w-10 h-10 bg-white rounded-xl border border-slate-100 flex items-center justify-center font-black text-slate-700 text-sm">
                                            {{ substr($member->user->name, 0, 1) }}
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-green-500 rounded-full border-2 border-white shadow-sm shadow-green-200"></div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-black text-slate-800">{{ $member->user->name }}</p>
                                        @if($member->user_id === $colocation->user_id)
                                            <p class="text-[9px] font-bold text-rose-500">Boss (Vous)</p>
                                        @else
                                            <p class="text-[9px] font-bold text-green-500">Actif maintenant</p>
                                        @endif
                                    </div>
                                    <div class="absolute right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                                    </div>
                                </div>
                             @endforeach
                        </div>
                    </div>

                    <!-- Chat Main Area -->
                    <div class="flex-1 flex flex-col min-w-0">
                        <div class="p-8 border-b border-slate-50 bg-white flex justify-between items-center relative z-20">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" /></svg>
                                </div>
                                <div>
                                    <h3 class="font-black text-slate-900 text-lg uppercase tracking-tight">Group Chat EasyColoc</h3>
                                    <p class="text-[10px] text-slate-400 font-bold tracking-widest">{{ $colocation->name }} • Dashboard Propriétaire</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="p-3 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex-1 p-8 overflow-y-auto space-y-10 bg-slate-50/50 backdrop-blur-sm bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] bg-opacity-5">
                            <div class="flex flex-col items-center">
                                <span class="px-6 py-2 bg-white text-slate-500 rounded-full text-[10px] font-black uppercase shadow-sm border border-slate-100 tracking-widest">Aujourd'hui, 23 Fév</span>
                            </div>

                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-600 flex-shrink-0 flex items-center justify-center text-white font-black shadow-lg shadow-blue-100">Y</div>
                                <div class="space-y-2 max-w-[80%]">
                                    <p class="text-[10px] font-black text-slate-400 ml-1 uppercase tracking-tighter text-left">Yassine mectoub • Membre</p>
                                    <div class="bg-white p-5 rounded-3xl rounded-tl-none shadow-sm border border-slate-100 text-sm text-slate-700 leading-relaxed text-left relative group">
                                        Salam tout le monde! Est-ce que quelqu'un a vu le dernier relevé d'électricité ?
                                        <div class="absolute -right-10 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button class="text-xs text-slate-300 hover:text-indigo-500">💡</button>
                                        </div>
                                    </div>
                                    <span class="text-[9px] text-slate-300 font-bold ml-1 tracking-widest">10:15</span>
                                </div>
                            </div>

                            <div class="flex gap-4 justify-end">
                                <div class="space-y-2 max-w-[80%] text-right">
                                    <p class="text-[10px] font-black text-indigo-500 mr-1 uppercase tracking-tighter">Moi (Boss)</p>
                                    <div class="bg-gradient-to-br from-indigo-600 to-indigo-700 p-5 rounded-3xl rounded-tr-none shadow-2xl shadow-indigo-100 text-sm text-white leading-relaxed text-left">
                                        Oui Yassine, je vais l'ajouter dans l'onglet Dépenses tout de suite. Sara a déjà réglé sa part d'ailleurs!
                                    </div>
                                    <span class="text-[9px] text-slate-300 font-bold mr-1 tracking-widest">10:18 • LU</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 bg-white border-t border-slate-50 relative z-20">
                            <div class="relative flex items-center gap-4">
                                <div class="flex-1 relative flex items-center">
                                    <div class="absolute left-6 text-slate-300 group-focus-within:text-indigo-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <input type="text" placeholder="Ecrivez à vos colocs..." class="w-full pl-16 pr-6 py-5 bg-slate-50 border-transparent rounded-[1.8rem] text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all font-medium text-sm">
                                </div>
                                <button class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-700 text-white rounded-2xl flex items-center justify-center shadow-2xl shadow-indigo-100 hover:scale-105 active:scale-95 transition-all">
                                    <svg class="w-6 h-6 rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                                </button>
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
