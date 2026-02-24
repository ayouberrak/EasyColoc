<x-app-layout>
    <div class="bg-white border-b border-slate-100 sticky top-[72px] md:top-[80px] z-40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Sub-Navbar Links -->
                <div class="flex items-center space-x-12">
                    <a href="{{ route('dashboard', ['tab' => 'dashboard']) }}" 
                       class="relative py-5 text-sm font-bold transition-all {{ $tab === 'dashboard' ? 'text-blue-600' : 'text-slate-500 hover:text-slate-800' }}">
                        Ma Balance
                        @if($tab === 'dashboard') <span class="absolute bottom-0 left-0 w-full h-1 bg-blue-600 rounded-t-full shadow-[0_0_10px_rgba(37,99,235,0.3)]"></span> @endif
                    </a>
                    <a href="{{ route('dashboard', ['tab' => 'expenses']) }}" 
                       class="relative py-5 text-sm font-bold transition-all {{ $tab === 'expenses' ? 'text-blue-600' : 'text-slate-500 hover:text-slate-800' }}">
                        Dépenses
                        @if($tab === 'expenses') <span class="absolute bottom-0 left-0 w-full h-1 bg-blue-600 rounded-t-full shadow-[0_0_10px_rgba(37,99,235,0.3)]"></span> @endif
                    </a>
                    <a href="{{ route('dashboard', ['tab' => 'members']) }}" 
                       class="relative py-5 text-sm font-bold transition-all {{ $tab === 'members' ? 'text-blue-600' : 'text-slate-500 hover:text-slate-800' }}">
                        Colocataires
                        @if($tab === 'members') <span class="absolute bottom-0 left-0 w-full h-1 bg-blue-600 rounded-t-full shadow-[0_0_10px_rgba(37,99,235,0.3)]"></span> @endif
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-3">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rôle</span>
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black rounded-full border border-blue-100 uppercase tracking-widest">Colocataire actif</span>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 bg-[#f8fafc] min-h-screen pt-24 md:pt-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($tab === 'dashboard')
                <!-- TAB: MEMBER DASHBOARD -->
                <div class="animate-fade-in space-y-12">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <h1 class="text-4xl font-black text-slate-900 tracking-tight font-heading">Salam, {{ Auth::user()->name }} 👋</h1>
                            <p class="text-slate-500 font-medium mt-1">Heureux de vous revoir dans la colocation <span class="text-blue-600 font-black tracking-tight">{{ $colocation->name }}</span>.</p>
                        </div>
                        <div class="premium-card p-4 flex items-center gap-4 bg-white">
                            <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600">
                                <svg class="w-6 h-6 border-2 border-green-100 rounded-full p-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Statut financier</p>
                                <p class="text-sm font-black text-slate-900 mt-1">À jour • Ce mois-ci</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                        @php
                            $staticMembers = [
                                ['name' => 'Sara Lmkadem', 'role' => 'Colocataire', 'balance' => -1420.00, 'status' => 'En retard', 'color' => 'red', 'avatar' => 'S'],
                                ['name' => 'Yassine Karim', 'role' => 'Propriétaire', 'balance' => 0.00, 'status' => 'À jour', 'color' => 'green', 'avatar' => 'Y'],
                                ['name' => 'Amine Bennani', 'role' => 'Colocataire', 'balance' => -350.50, 'status' => 'En attente', 'color' => 'orange', 'avatar' => 'A'],
                                ['name' => 'Meryem Tazi', 'role' => 'Colocataire', 'balance' => 0.00, 'status' => 'À jour', 'color' => 'green', 'avatar' => 'M'],
                            ];
                        @endphp

                        <!-- Left Column: Primary Focus (Situation de la Coloc) -->
                        <div class="lg:col-span-8 space-y-10">
                            <!-- Hero Feature: Situation de la Coloc -->
                            <div class="premium-card bg-white overflow-hidden shadow-2xl shadow-blue-100/40 border border-white">
                                <div class="p-10 border-b border-slate-50 flex items-center justify-between bg-gradient-to-r from-slate-50/50 to-white">
                                    <div class="flex items-center gap-5">
                                        <div class="w-14 h-14 bg-blue-600 rounded-[1.5rem] shadow-xl shadow-blue-200 flex items-center justify-center text-white ring-4 ring-blue-50">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                        </div>
                                        <div>
                                            <h3 class="text-3xl font-black text-slate-900 font-heading tracking-tight lowercase first-letter:uppercase">Situation de la coloc</h3>
                                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Transparence financière en temps réel</p>
                                        </div>
                                    </div>
                                    <span class="pulse-container flex items-center gap-2 px-4 py-2 bg-green-50 rounded-xl border border-green-100">
                                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                        <span class="text-[10px] font-black text-green-700 uppercase tracking-widest">Live Sync</span>
                                    </span>
                                </div>
                                
                                <div class="divide-y divide-slate-50">
                                    @foreach($staticMembers as $member)
                                        <div class="p-8 flex items-center justify-between group hover:bg-slate-50/50 transition-all duration-500">
                                            <div class="flex items-center gap-8">
                                                <div class="relative">
                                                    <div class="w-20 h-20 bg-white rounded-[2rem] flex items-center justify-center font-black text-slate-800 text-3xl border border-slate-100 shadow-sm transition-all duration-700 group-hover:scale-105 group-hover:-rotate-3 group-hover:border-blue-200 overflow-hidden">
                                                        <span class="relative z-10">{{ $member['avatar'] }}</span>
                                                        <div class="absolute inset-0 bg-blue-50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                                    </div>
                                                    <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full border-4 border-white shadow-sm {{ $member['balance'] < 0 ? 'bg-red-500' : 'bg-green-500' }}"></div>
                                                </div>
                                                <div>
                                                    <p class="text-xl font-black text-slate-900 tracking-tight transition-colors group-hover:text-blue-600">{{ $member['name'] }}</p>
                                                    <div class="flex items-center gap-3 mt-1.5">
                                                        <span class="px-2 py-0.5 bg-slate-50 rounded text-[9px] font-black text-slate-400 uppercase tracking-widest border border-slate-100">{{ $member['role'] }}</span>
                                                        <span class="w-1.5 h-1.5 bg-slate-200 rounded-full"></span>
                                                        <span class="text-[10px] font-black uppercase tracking-widest {{ $member['balance'] < 0 ? 'text-red-500' : 'text-green-600' }}">
                                                            {{ $member['status'] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right flex flex-col items-end gap-3">
                                                <div class="text-3xl font-black {{ $member['balance'] < 0 ? 'text-red-600' : 'text-green-600' }} font-heading tracking-tighter">
                                                    {{ number_format($member['balance'], 2) }} <span class="text-xs ml-1 uppercase opacity-60">DH</span>
                                                </div>
                                                @if($member['balance'] < 0)
                                                    <button class="group/btn flex items-center gap-2 px-5 py-2 bg-blue-600 text-white text-[10px] font-black rounded-xl uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-blue-100 overflow-hidden relative">
                                                        <span class="relative z-10">Relancer</span>
                                                        <svg class="w-3 h-3 relative z-10 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                                                    </button>
                                                @else
                                                    <div class="flex items-center gap-2 px-4 py-1.5 bg-green-50 rounded-full border border-green-100">
                                                        <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                                        <span class="text-[9px] font-black text-green-700 uppercase tracking-widest">Réglé</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="bg-slate-900 p-10 flex items-center justify-between">
                                    <div class="flex items-center gap-6">
                                        <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center text-white/40 border border-white/5">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Total à collecter (Mois d'Avril)</p>
                                            <p class="text-3xl font-black text-white tracking-tighter">1,770.50 <span class="text-sm font-medium text-slate-500 ml-2">DH</span></p>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <button class="px-7 py-4 bg-white text-slate-900 text-xs font-black rounded-2xl uppercase tracking-widest hover:scale-105 transition-all shadow-xl active:scale-95">Extraire Rapport</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment History Simplified & Improved -->
                            <div class="premium-card bg-white p-10 border border-slate-100 shadow-sm">
                                <div class="flex items-center justify-between mb-8">
                                    <h3 class="text-xl font-black text-slate-900 font-heading tracking-tight lowercase first-letter:uppercase">Mouvements récents</h3>
                                    <button class="text-[10px] font-black text-blue-600 uppercase tracking-widest hover:underline">Voir Historique</button>
                                </div>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-6 bg-slate-50/50 rounded-3xl border border-slate-50 transition-all hover:bg-white hover:border-blue-100 hover:shadow-xl hover:shadow-blue-50/30 group">
                                        <div class="flex items-center gap-5">
                                            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-green-600 shadow-sm border border-slate-100 group-hover:scale-110 group-hover:rotate-3 transition-transform">
                                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            </div>
                                            <div>
                                                <p class="text-base font-black text-slate-800 tracking-tight">Virement Loyer • Sara</p>
                                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Hier • 18:30</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xl font-black text-slate-900 tracking-tighter">1,250.00 DH</p>
                                            <span class="text-[9px] font-black text-green-600 uppercase tracking-widest">Success</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Secondary Info -->
                        <div class="lg:col-span-4 space-y-10 lg:sticky lg:top-36">
                            <!-- Premium Summary Card -->
                            <div class="premium-card p-10 bg-white border border-slate-100 shadow-xl shadow-slate-200/20">
                                <h3 class="text-xl font-black text-slate-900 mb-8 font-heading tracking-tight lowercase first-letter:uppercase">Global Coloc</h3>
                                <div class="space-y-8">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-semibold text-slate-500">Dépenses partagées</span>
                                        <span class="text-lg font-black text-slate-900 font-heading">4,369 DH</span>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden p-0.5 shadow-inner">
                                            <div class="bg-blue-600 h-full w-[65%] rounded-full shadow-[0_0_15px_rgba(37,99,235,0.4)] transition-all duration-1000"></div>
                                        </div>
                                        <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest">
                                            <span class="text-slate-400 font-bold">Encaissement</span>
                                            <span class="text-blue-600 font-black">65%</span>
                                        </div>
                                    </div>
                                    
                                    <div class="pt-8 border-t border-slate-50">
                                        <div class="p-6 bg-blue-50/50 rounded-2xl border border-blue-100/20 flex flex-col gap-3">
                                            <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Ma part mensuelle</p>
                                            <div class="flex items-end gap-2">
                                                <span class="text-3xl font-black text-slate-900 tracking-tighter">1,166</span>
                                                <span class="text-xs font-bold text-slate-400 uppercase mb-1.5">DH</span>
                                            </div>
                                            <button class="w-full mt-2 py-3 bg-white border border-slate-200 text-slate-900 text-[10px] font-black rounded-xl uppercase tracking-widest hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all shadow-sm">Régler maintenant</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Premium Support/Help Card -->
                            <div class="bg-slate-900 p-10 rounded-[2.5rem] shadow-2xl shadow-slate-200 text-white relative overflow-hidden group">
                                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-2xl transition-transform group-hover:scale-150 duration-1000"></div>
                                <div class="relative z-10">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 opacity-60">Status</p>
                                    <div class="text-3xl font-black font-heading tracking-tight">Tout est OK ✨</div>
                                    <p class="mt-4 text-[11px] font-medium text-slate-400 leading-relaxed">
                                        Votre colocation est saine. Aucun retard critique n'a été détecté pour le moment.
                                    </p>
                                    <div class="mt-8 flex items-center gap-3">
                                        <div class="flex -space-x-2">
                                            @foreach($staticMembers as $m)
                                                <div class="w-8 h-8 rounded-full border-2 border-slate-900 bg-slate-800 flex items-center justify-center text-[10px] font-bold">{{ $m['avatar'] }}</div>
                                            @endforeach
                                        </div>
                                        <span class="text-[10px] font-bold text-slate-500 uppercase">4 Membres</span>
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
                            <h2 class="text-3xl font-black text-slate-900 tracking-tight font-heading">Frais de la Maison</h2>
                            <p class="text-slate-500 font-medium mt-1">Ajoutez vos dépenses pour les partager avec tout le monde.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                        <div class="lg:col-span-5">
                            <div class="bg-white p-10 md:p-12 rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white sticky top-36">
                                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-8 border border-blue-100">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <h3 class="text-2xl font-black text-slate-900 mb-2">Nouvelle Dépense</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-10">Saisissez un achat partagé.</p>

                                @if(session('success'))
                                    <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-2xl border border-green-100 text-sm font-bold animate-fade-in">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('expense.store') }}" method="POST" class="space-y-8">
                                    @csrf
                                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Name </label>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Name of the expense" class="w-full px-8 py-5 bg-slate-50 border-transparent rounded-[1.5rem] text-slate-800 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all font-bold text-lg @error('name') border-red-500 @enderror">
                                        @error('name')
                                            <p class="text-red-500 text-[10px] font-bold mt-1 px-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="grid grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-2 text-left">Montant</label>
                                            <input type="number" name="amount" value="{{ old('amount') }}" placeholder="0.00" step="0.01" class="w-full px-8 py-5 bg-slate-50 border-transparent rounded-[1.5rem] text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 font-black text-2xl @error('amount') border-red-500 @enderror">
                                            @error('amount')
                                                <p class="text-red-500 text-[10px] font-bold mt-1 px-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-2 text-left">Catégorie</label>
                                            <select name="category_id" class="w-full px-8 py-5 bg-slate-50 border-transparent rounded-[1.5rem] text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 font-bold transition-all appearance-none cursor-pointer @error('category_id') border-red-500 @enderror">
                                                <option value="">Choisir...</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <p class="text-red-500 text-[10px] font-bold mt-1 px-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-2 text-left">Date</label>
                                            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="w-full px-8 py-5 bg-slate-50 border-transparent rounded-[1.5rem] text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 font-bold transition-all appearance-none cursor-pointer @error('date') border-red-500 @enderror">
                                            @error('date')
                                                <p class="text-red-500 text-[10px] font-bold mt-1 px-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="w-full py-6 bg-blue-600 text-white font-black rounded-[1.5rem] hover:bg-blue-700 transition shadow-2xl shadow-blue-200 transform active:scale-[0.98] text-lg">
                                        Enregistrer la dépense 
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="lg:col-span-7">
                            <div class="bg-white p-10 md:p-12 rounded-[3rem] shadow-xl shadow-slate-200/50 border border-white">
                                <div class="flex items-center justify-between mb-10">
                                    <h3 class="text-2xl font-black text-slate-900 lowercase first-letter:uppercase">Journal des dépenses</h3>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Février 2026</span>
                                </div>
                                <div class="space-y-4">
                                    @forelse($colocation->expenses->sortByDesc('date') as $expense)
                                        <div class="p-8 bg-slate-50/50 rounded-[2rem] border border-slate-50 flex items-center justify-between group hover:bg-white hover:shadow-xl hover:shadow-blue-100/30 transition-all">
                                            <div class="flex items-center gap-6">
                                                <div class="w-16 h-16 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center group-hover:scale-110 transition-transform text-blue-600 font-black">
                                                    {{ substr($expense->titre, 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="text-lg font-black text-slate-900">{{ $expense->titre }}</p>
                                                    <div class="flex items-center gap-3 mt-1">
                                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($expense->date)->diffForHumans() }}</span>
                                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                                        <span class="px-2 py-0.5 {{ $expense->user_id === Auth::id() ? 'bg-blue-50 text-blue-600' : 'bg-slate-100 text-slate-500' }} text-[8px] font-black rounded-md uppercase">
                                                            {{ $expense->user_id === Auth::id() ? 'Moi' : $expense->payer->name }}
                                                        </span>
                                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                                        <span class="px-2 py-0.5 bg-green-50 text-green-600 text-[8px] font-black rounded-md uppercase">
                                                            {{ $expense->category->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-2xl font-black text-slate-900 tracking-tighter">{{ number_format($expense->amount, 2) }} DH</p>
                                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                                    Par : {{ $expense->payer->name }}
                                                </p>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-12 text-center bg-slate-50/50 rounded-[2rem] border-2 border-dashed border-slate-200">
                                            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-slate-300 mx-auto mb-4 border border-slate-100">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            </div>
                                            <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Aucune dépense enregistrée</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif($tab === 'members')
                <!-- TAB: MEMBERS VIEW -->
                <div class="animate-fade-in space-y-12">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <h1 class="text-4xl font-black text-slate-900 tracking-tight font-heading">L'équipe EasyColoc</h1>
                            <p class="text-slate-500 font-medium mt-1">Vos colocataires de confiance dans <span class="text-blue-600 font-black">{{ $colocation->name }}</span>.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($colocation->members as $member)
                            <div class="premium-card p-10 bg-white text-center group">
                                <div class="relative inline-block mb-6">
                                    <div class="w-24 h-24 bg-slate-50 rounded-[2rem] flex items-center justify-center font-black text-slate-800 text-4xl border border-slate-100 transition-transform group-hover:scale-110 group-hover:rotate-3 duration-500">
                                        {{ substr($member->user->name, 0, 1) }}
                                    </div>
                                    @if($member->user_id === Auth::id())
                                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" /></svg>
                                        </div>
                                    @endif
                                </div>
                                <h4 class="text-2xl font-black text-slate-900 tracking-tight">{{ $member->user->name }}</h4>
                                <div class="mt-2 flex items-center justify-center gap-2">
                                     <span class="px-2.5 py-1 bg-slate-50 text-slate-500 text-[9px] font-black rounded-lg border border-slate-100 uppercase tracking-widest">
                                        {{ $member->user_id === $colocation->user_id ? 'Propriétaire' : 'Colocataire' }}
                                     </span>
                                     <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                </div>
                                
                                <div class="mt-8 pt-8 border-t border-slate-50 grid grid-cols-2 gap-6">
                                    <div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Membre depuis</p>
                                        <p class="text-sm font-bold text-slate-800 mt-1">{{ $member->created_at->format('M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status Paiement</p>
                                        <p class="text-sm font-black text-green-600 mt-1">À jour</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            @endif

        </div>
    </div>
</x-app-layout>
