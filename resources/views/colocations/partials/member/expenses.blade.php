<!-- TAB: EXPENSES (MEMBER VIEW) -->
<div class="animate-fade-in space-y-12">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Frais de la Maison</h2>
            <p class="text-slate-500 font-medium mt-1">Ajoutez vos dépenses pour les partager avec tout le monde.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Expense Form -->
        <div class="lg:col-span-5">
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-100 border border-slate-50 lg:sticky lg:top-36">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-8 border border-blue-100">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Nouvelle Dépense</h3>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-10">Saisissez un achat partagé.</p>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100 text-[10px] font-bold uppercase tracking-widest">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('expense.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Titre</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Ex: Courses, Internet..." class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all font-bold">
                        @error('name') <p class="text-red-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Montant (DH)</label>
                            <input type="number" name="amount" value="{{ old('amount') }}" placeholder="0.00" step="0.01" class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-xl text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 font-bold transition-all">
                            @error('amount') <p class="text-red-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Catégorie</label>
                            <select name="category_id" class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-xl text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 font-bold transition-all appearance-none cursor-pointer">
                                <option value="">Choisir...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Date</label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-xl text-slate-900 focus:bg-white focus:ring-4 focus:ring-blue-100 font-bold transition-all">
                        @error('date') <p class="text-red-500 text-[10px] font-bold mt-1 px-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full py-5 bg-blue-600 text-white text-[11px] font-bold rounded-xl uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-blue-100">
                        Ajouter la dépense
                    </button>
                </form>
            </div>
        </div>

        <!-- Expense Log -->
        <div class="lg:col-span-7">
            <div class="card-simple p-8 md:p-10 bg-white border border-slate-100 overflow-hidden">
                <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-6 mb-10">
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">Journal des dépenses</h3>
                    <form action="{{ url()->current() }}" method="GET" class="flex flex-wrap items-center gap-3">
                        <input type="hidden" name="tab" value="expenses">
                        <div class="relative group">
                            <select name="month" class="appearance-none pl-5 pr-12 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-[11px] font-extrabold text-slate-600 uppercase tracking-widest focus:ring-4 focus:ring-blue-100/50 transition-all cursor-pointer group-hover:bg-white group-hover:border-blue-100 group-hover:shadow-lg group-hover:shadow-blue-50/50">
                                <option value="">Mois</option>
                                @php
                                    $months = [
                                        '1' => 'Janvier', '2' => 'Février', '3' => 'Mars', '4' => 'Avril',
                                        '5' => 'Mai', '6' => 'Juin', '7' => 'Juillet', '8' => 'Août',
                                        '9' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
                                    ];
                                @endphp
                                @foreach($months as $num => $name)
                                    <option value="{{ $num }}" {{ request('month') == $num ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-hover:text-blue-500 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                        <div class="relative group">
                            <select name="year" class="appearance-none pl-5 pr-12 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-[11px] font-extrabold text-slate-600 uppercase tracking-widest focus:ring-4 focus:ring-blue-100/50 transition-all cursor-pointer group-hover:bg-white group-hover:border-blue-100 group-hover:shadow-lg group-hover:shadow-blue-50/50">
                                <option value="">Année</option>
                                @php $currentYear = date('Y'); @endphp
                                <option value="{{ $currentYear }}" {{ request('year') == $currentYear ? 'selected' : '' }}>{{ $currentYear }}</option>
                                <option value="{{ $currentYear - 1 }}" {{ request('year') == ($currentYear - 1) ? 'selected' : '' }}>{{ $currentYear - 1 }}</option>
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-hover:text-blue-500 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                        <button type="submit" class="p-4 bg-slate-900 text-white rounded-2xl hover:bg-blue-600 transition-all shadow-xl shadow-slate-100 hover:shadow-blue-200 active:scale-95 group">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                    </form>
                </div>
                <div class="space-y-4">
                    @forelse($expenses as $expense)
                        <div class="p-6 bg-slate-50/50 rounded-2xl border border-slate-50 flex items-center justify-between hover:bg-white hover:shadow-xl hover:shadow-blue-50/20 transition-all">
                            <div class="flex items-center gap-5">
                                <div class="w-14 h-14 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center font-bold text-blue-600">
                                    {{ substr($expense->titre, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-base font-bold text-slate-900 tracking-tight">{{ $expense->titre }}</p>
                                    <div class="flex items-center gap-2 mt-1.5">
                                        <div class="flex items-center gap-1.5 px-2 py-0.5 bg-slate-100/50 rounded-md">
                                            <svg class="w-2.5 h-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            <span class="text-[9px] font-extrabold text-slate-500 uppercase tracking-widest">{{ date('d M, Y', strtotime($expense->date)) }}</span>
                                        </div>
                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                        <span class="px-2 py-0.5 {{ $expense->user_id === Auth::id() ? 'bg-blue-50 text-blue-600' : 'bg-slate-100 text-slate-500' }} text-[8px] font-black rounded-md uppercase tracking-wider">
                                            {{ $expense->user_id === Auth::id() ? 'Moi' : $expense->payer->name }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-bold text-slate-900 tracking-tight">{{ number_format($expense->amount, 2) }} DH</p>
                                <p class="text-[9px] text-green-600 font-bold uppercase tracking-widest mt-1">Partagée</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 bg-slate-50/50 rounded-[2rem] border-2 border-dashed border-slate-100">
                             <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Aucune dépense récente</p>
                        </div>
                    @endforelse
                </div>
                @if($colocation->expenses->count() > 10)
                    <div class="mt-8 text-center">
                        <button class="text-[10px] font-bold text-blue-600 uppercase tracking-widest hover:underline">Voir tout l'historique</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
