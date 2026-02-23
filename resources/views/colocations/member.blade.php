<x-app-layout>
    <div class="bg-white border-b border-slate-100 sticky top-16 z-40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Sub-Navbar Links -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('dashboard', ['tab' => 'dashboard']) }}" 
                       class="relative py-5 text-sm font-black transition-all {{ $tab === 'dashboard' ? 'text-blue-600' : 'text-slate-500 hover:text-slate-800' }}">
                        Ma Balance
                        @if($tab === 'dashboard') <span class="absolute bottom-0 left-0 w-full h-1 bg-blue-600 rounded-t-full"></span> @endif
                    </a>
                    <a href="{{ route('dashboard', ['tab' => 'members']) }}" 
                       class="relative py-5 text-sm font-black transition-all {{ $tab === 'members' ? 'text-indigo-600' : 'text-slate-500 hover:text-slate-800' }}">
                        Membres
                        @if($tab === 'members') <span class="absolute bottom-0 left-0 w-full h-1 bg-indigo-600 rounded-t-full"></span> @endif
                    </a>
                    <a href="{{ route('dashboard', ['tab' => 'chat']) }}" 
                       class="relative py-5 text-sm font-black transition-all {{ $tab === 'chat' ? 'text-green-600' : 'text-slate-500 hover:text-slate-800' }}">
                        Group Chat
                        <span class="ml-2 px-1.5 py-0.5 bg-green-100 text-green-600 text-[8px] rounded-md animate-pulse">LIVE</span>
                        @if($tab === 'chat') <span class="absolute bottom-0 left-0 w-full h-1 bg-green-600 rounded-t-full"></span> @endif
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-3">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Mon Rôle</span>
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black rounded-full border border-blue-100 uppercase tracking-widest">Colocataire</span>
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
                <!-- TAB: MEMBER BALANCE (ENHANCED) -->
                <div class="animate-fade-in space-y-10">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Salam, {{ Auth::user()->name }} 👋</h1>
                            <p class="text-slate-500 font-medium mt-1">Vous faites partie de la colocation <span class="text-blue-600 font-black">{{ $colocation->name }}</span>.</p>
                        </div>
                        <div class="flex items-center gap-4 bg-white p-4 rounded-3xl shadow-xl shadow-slate-200/50 border border-white">
                            <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Status de paiement</p>
                                <p class="text-sm font-black text-slate-900 mt-1">À jour pour Février</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                        <div class="lg:col-span-8 space-y-10">
                            <!-- Main Balance Card -->
                            <div class="relative overflow-hidden group">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-700 to-indigo-900 rounded-[3rem] transform transition-transform group-hover:scale-[1.01] duration-500"></div>
                                <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
                                
                                <div class="relative p-12 text-white flex flex-col md:flex-row items-center justify-between gap-10">
                                    <div class="space-y-6">
                                        <div>
                                            <p class="text-[10px] font-black text-blue-100 uppercase tracking-widest mb-2 opacity-80">Ma Balance ce mois-ci</p>
                                            <div class="text-6xl font-black tracking-tighter">- 1,240.50 DH</div>
                                        </div>
                                        <div class="flex items-center gap-6">
                                            <div class="flex flex-col">
                                                <span class="text-[9px] font-black text-blue-200 uppercase tracking-widest">LOYER</span>
                                                <span class="text-lg font-black">1,166 DH</span>
                                            </div>
                                            <div class="w-[1px] h-8 bg-white/20"></div>
                                            <div class="flex flex-col">
                                                <span class="text-[9px] font-black text-blue-200 uppercase tracking-widest">CHARGES</span>
                                                <span class="text-lg font-black">74.50 DH</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="w-full md:w-auto px-10 py-5 bg-white text-blue-700 font-black rounded-2xl shadow-2xl hover:bg-slate-50 transition-all flex items-center justify-center gap-3 active:scale-95 group/btn">
                                        Verser ma part
                                        <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Personal Payment History -->
                            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-white overflow-hidden">
                                <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                                    <h3 class="text-xl font-black text-slate-900">Mes derniers règlements</h3>
                                    <button class="text-xs font-bold text-blue-600 hover:underline">Voir tout</button>
                                </div>
                                <div class="p-4 space-y-3">
                                    <div class="flex items-center justify-between p-6 bg-slate-50 rounded-3xl border border-slate-100 hover:border-blue-200 transition-colors">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-green-600">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-slate-800">Part Loyer Janvier</p>
                                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest font-outfit">Payé le 02 Jan, 2026</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-black text-slate-900">1,166 DH</p>
                                            <span class="text-[9px] font-black text-green-600 uppercase">Confirmé</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between p-6 bg-white rounded-3xl border border-slate-100">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-slate-800">Charges Internet Janvier</p>
                                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Payé le 28 Déc, 2025</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-black text-slate-900">116 DH</p>
                                            <span class="text-[9px] font-black text-green-600 uppercase">Confirmé</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-4 space-y-8">
                            <!-- Coloc Summary Card -->
                            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-white">
                                <h3 class="text-xl font-black text-slate-900 mb-6">Résumé Coloc</h3>
                                <div class="space-y-6">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-slate-500">Charges globales</span>
                                        <span class="text-sm font-black text-slate-900">4,369 DH</span>
                                    </div>
                                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                        <div class="bg-blue-600 h-full w-[65%]"></div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-black text-slate-400 uppercase">Progrès règlements</span>
                                        <span class="text-[10px] font-black text-blue-600 uppercase">65% Collecté</span>
                                    </div>
                                    <div class="pt-6 border-t border-slate-50">
                                        <div class="flex items-center gap-4 p-4 bg-blue-50 rounded-2xl border border-blue-100">
                                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-blue-600 shadow-sm">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            </div>
                                            <div>
                                                <p class="text-[10px] font-black text-blue-400 uppercase leading-none mb-1">Dernier paiement coloc</p>
                                                <p class="text-xs font-bold text-blue-800">Sara y'a 2h</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Contribution -->
                            <div class="bg-indigo-600 p-10 rounded-[2.5rem] shadow-2xl shadow-indigo-100 text-white relative overflow-hidden">
                                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
                                <p class="text-[10px] font-black text-indigo-100 uppercase tracking-widest mb-2 opacity-80">Ma Contribution Totale</p>
                                <div class="text-4xl font-black">12,500 DH</div>
                                <p class="mt-4 text-[10px] font-bold text-indigo-200 italic">Membre fidèle depuis 6 mois ✨</p>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif($tab === 'members')
                <!-- TAB: MEMBERS LIST (ENHANCED) -->
                <div class="animate-fade-in space-y-12">
                     <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Famille EasyColoc</h2>
                            <p class="text-slate-500 font-medium mt-1">Les personnes incroyables avec qui vous partagez votre quotidien.</p>
                        </div>
                        <div class="flex -space-x-4 overflow-hidden">
                            @foreach($colocation->members as $member)
                                <div class="inline-block h-12 w-12 rounded-full ring-4 ring-white bg-slate-100 border border-slate-200 flex items-center justify-center font-black text-slate-700 uppercase">
                                    {{ substr($member->user->name, 0, 1) }}
                                </div>
                            @endforeach
                        </div>
                     </div>

                     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                         @foreach($colocation->members as $member)
                            <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-white hover:border-blue-200 transition-all group overflow-hidden relative">
                                <div class="absolute top-0 right-0 w-24 h-24 bg-slate-50 rotate-45 translate-x-12 -translate-y-12 transition-transform group-hover:bg-blue-50"></div>
                                
                                <div class="flex flex-col items-center text-center space-y-4">
                                    <div class="w-20 h-20 bg-gradient-to-br from-slate-50 to-slate-100 rounded-3xl flex items-center justify-center font-black text-slate-800 text-3xl border border-slate-100 uppercase group-hover:scale-110 transition-transform">
                                        {{ substr($member->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-black text-slate-900">{{ $member->user->name }}</h4>
                                        <div class="flex items-center justify-center gap-2 mt-1">
                                            @if($member->user_id === $colocation->user_id)
                                                <span class="px-2 py-0.5 bg-rose-50 text-rose-600 text-[8px] font-black rounded-md border border-rose-100 uppercase tracking-widest">Propriétaire</span>
                                            @else
                                                <span class="px-2 py-0.5 bg-blue-50 text-blue-600 text-[8px] font-black rounded-md border border-blue-100 uppercase tracking-widest">Membre</span>
                                            @endif
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                        </div>
                                    </div>
                                    <div class="w-full pt-6 grid grid-cols-2 gap-4">
                                        <div class="bg-slate-50 p-3 rounded-2xl">
                                            <p class="text-[9px] font-black text-slate-400 uppercase">Trust Score</p>
                                            <p class="text-lg font-black text-slate-900">98%</p>
                                        </div>
                                        <div class="bg-slate-50 p-3 rounded-2xl">
                                            <p class="text-[9px] font-black text-slate-400 uppercase">Payé ce mois</p>
                                            <p class="text-lg font-black text-green-600">OUI</p>
                                        </div>
                                    </div>
                                    <button class="w-full py-4 text-[10px] font-black uppercase text-blue-600 hover:bg-blue-50 rounded-2xl transition-all tracking-widest">Voir le profil</button>
                                </div>
                            </div>
                         @endforeach
                     </div>
                </div>

            @elseif($tab === 'chat')
                <!-- TAB: GROUP CHAT (PREMIUM) -->
                <div class="animate-fade-in bg-white rounded-[3rem] shadow-2xl border border-white overflow-hidden h-[750px] flex flex-col md:flex-row">
                    <!-- Sidebar Membres (Desktop) -->
                    <div class="hidden lg:flex w-72 border-r border-slate-50 flex-col bg-slate-50/20">
                        <div class="p-8 border-b border-slate-50">
                            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest">En ligne (3)</h4>
                        </div>
                        <div class="flex-1 overflow-y-auto p-4 space-y-2">
                             @foreach($colocation->members as $member)
                                <div class="flex items-center gap-3 p-3 rounded-2xl hover:bg-white hover:shadow-sm transition-all cursor-pointer group">
                                    <div class="relative">
                                        <div class="w-10 h-10 bg-white rounded-xl border border-slate-100 flex items-center justify-center font-black text-slate-700 text-sm">
                                            {{ substr($member->user->name, 0, 1) }}
                                        </div>
                                        <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-green-500 rounded-full border-2 border-white ring-1 ring-white"></div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-black text-slate-800">{{ $member->user->name }}</p>
                                        <p class="text-[9px] font-bold text-green-500">Actif maintenant</p>
                                    </div>
                                </div>
                             @endforeach
                        </div>
                    </div>

                    <!-- Chat Main Area -->
                    <div class="flex-1 flex flex-col min-w-0">
                        <div class="p-8 border-b border-slate-50 bg-white flex justify-between items-center relative z-20">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-green-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" /></svg>
                                </div>
                                <div>
                                    <h3 class="font-black text-slate-900 text-lg uppercase tracking-tight">Group Chat Coloc</h3>
                                    <p class="text-[10px] text-slate-400 font-bold tracking-widest">{{ $colocation->name }} • Canal Général</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="p-3 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex-1 p-8 overflow-y-auto space-y-10 bg-slate-50/50 backdrop-blur-sm relative bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] bg-opacity-5">
                            <!-- Messages -->
                            <div class="flex flex-col items-center">
                                <span class="px-6 py-2 bg-white/80 backdrop-blur text-slate-500 rounded-full text-[10px] font-black uppercase shadow-sm border border-slate-100 tracking-widest">Aujourd'hui, 23 Fév</span>
                            </div>

                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-xl bg-indigo-600 flex-shrink-0 flex items-center justify-center text-white font-black shadow-lg shadow-indigo-100">Y</div>
                                <div class="space-y-2 max-w-[80%]">
                                    <p class="text-[10px] font-black text-slate-400 ml-1 uppercase tracking-tighter">Yassine mectoub • Propriétaire</p>
                                    <div class="bg-white p-5 rounded-3xl rounded-tl-none shadow-sm border border-slate-100 text-sm text-slate-700 leading-relaxed relative group">
                                        Salam les colocs! J'ai reçu la facture d'eau, je vais l'ajouter dans les dépenses ce soir. C'est un peu plus que d'habitude.
                                        <div class="absolute -right-8 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button class="text-xs text-slate-300 hover:text-blue-500">❤️</button>
                                        </div>
                                    </div>
                                    <span class="text-[9px] text-slate-300 font-bold ml-1 tracking-widest">14:32</span>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-200 flex-shrink-0 flex items-center justify-center text-slate-600 font-black shadow-sm">S</div>
                                <div class="space-y-2 max-w-[80%]">
                                    <p class="text-[10px] font-black text-slate-400 ml-1 uppercase tracking-tighter">Sara.l • Membre</p>
                                    <div class="bg-white p-5 rounded-3xl rounded-tl-none shadow-sm border border-slate-100 text-sm text-slate-700 leading-relaxed shadow-sm">
                                        Pas de souci Yassine, merci pour l'info! Perso j'ai déjà versé ma part du loyer hani saliyt m3akom 😂
                                    </div>
                                    <span class="text-[9px] text-slate-300 font-bold ml-1 tracking-widest">14:50</span>
                                </div>
                            </div>

                            <div class="flex gap-4 justify-end">
                                <div class="space-y-2 max-w-[80%] text-right">
                                    <p class="text-[10px] font-black text-blue-500 mr-1 uppercase tracking-tighter">Moi</p>
                                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-5 rounded-3xl rounded-tr-none shadow-2xl shadow-blue-100 text-sm text-white leading-relaxed text-left">
                                        Nadi! Moi aussi j'ai réglé pour le loyer. On attend que Yassine valide tout ça sur le portail hhhh.
                                    </div>
                                    <span class="text-[9px] text-slate-300 font-bold mr-1 tracking-widest">15:12 • LU</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 bg-white border-t border-slate-50 relative z-20">
                            <div class="relative flex items-center gap-4">
                                <div class="flex-1 relative flex items-center">
                                    <div class="absolute left-6 text-slate-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <input type="text" placeholder="Ecrivez votre message ici..." class="w-full pl-16 pr-6 py-5 bg-slate-50 border-transparent rounded-[1.5rem] text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all font-medium text-sm">
                                </div>
                                <button class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center shadow-2xl shadow-blue-100 hover:bg-blue-700 hover:scale-105 active:scale-95 transition-all">
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
