<!-- TAB: EXPENSES -->
<div class="animate-fade-in space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Journal des frais</h2>
            <p class="text-slate-500 font-medium text-sm">Gérez les dépenses communes de la maison.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Add Expense -->
        <div class="lg:col-span-5">
            <div class="card-simple sticky top-24">
                <h3 class="text-lg font-bold text-slate-900 mb-6">Nouvelle Dépense</h3>

                <form action="{{ route('expense.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Description</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Ex: Courses Pack" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-medium text-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Montant (DH)</label>
                            <input type="number" name="amount" step="0.01" placeholder="0.00" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 font-bold text-sm">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Catégorie</label>
                            <select name="category_id" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 font-medium text-sm">
                                <option value="">Choisir...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Date</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 font-medium text-sm">
                    </div>

                    <button type="submit" class="w-full py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all shadow-sm active:scale-[0.98] text-sm">
                        Enregistrer la dépense
                    </button>
                </form>
            </div>
        </div>

        <!-- History -->
        <div class="lg:col-span-7">
            <div class="card-simple !p-0 overflow-hidden">
                <div class="p-8 border-b border-slate-100 flex flex-col xl:flex-row xl:items-center justify-between gap-6">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Journal des frais</h3>
                    <form action="{{ url()->current() }}" method="GET" class="flex items-center gap-3">
                        <input type="hidden" name="tab" value="expenses">
                        <div class="relative group">
                            <select name="month" class="appearance-none pl-4 pr-10 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-[10px] font-bold text-slate-500 uppercase tracking-widest focus:ring-4 focus:ring-blue-100/50 transition-all cursor-pointer group-hover:bg-white group-hover:border-blue-100">
                                <option value="">Mois</option>
                                @php
                                    $months = [
                                        '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr',
                                        '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug',
                                        '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'
                                    ];
                                @endphp
                                @foreach($months as $num => $name)
                                    <option value="{{ $num }}" {{ request('month') == $num ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                        <div class="relative group">
                            <select name="year" class="appearance-none pl-4 pr-10 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-[10px] font-bold text-slate-500 uppercase tracking-widest focus:ring-4 focus:ring-blue-100/50 transition-all cursor-pointer group-hover:bg-white group-hover:border-blue-100">
                                <option value="">Année</option>
                                @php $currentYear = date('Y'); @endphp
                                <option value="{{ $currentYear }}" {{ request('year') == $currentYear ? 'selected' : '' }}>{{ $currentYear }}</option>
                                <option value="{{ $currentYear - 1 }}" {{ request('year') == ($currentYear - 1) ? 'selected' : '' }}>{{ $currentYear - 1 }}</option>
                            </select>
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                        <button type="submit" class="p-2.5 bg-slate-900 text-white rounded-xl hover:bg-blue-600 transition-all shadow-lg shadow-slate-100 active:scale-95 group">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                    </form>
                </div>
                <div class="divide-y divide-slate-50">
                    @forelse($colocation->expenses->sortByDesc('date') as $expense)
                        <div class="p-5 flex items-center justify-between hover:bg-slate-50/50 transition-colors group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center font-bold text-xs uppercase">
                                    {{ substr($expense->titre, 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-slate-900 truncate">{{ $expense->titre }}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="flex items-center gap-1.5 px-2 py-0.5 bg-slate-100/50 rounded-md">
                                            <svg class="w-2.5 h-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            <span class="text-[9px] font-extrabold text-slate-500 uppercase tracking-widest">{{ date('d M, Y', strtotime($expense->date)) }}</span>
                                        </div>
                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                        <span class="text-[9px] font-extrabold text-blue-600 uppercase italic">{{ $expense->payer->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-slate-900">{{ number_format($expense->amount, 2) }} DH</p>
                                <p class="text-[9px] text-slate-400 font-bold uppercase mt-0.5">{{ $expense->category->name }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <p class="text-slate-400 text-xs font-medium">Aucune dépense enregistrée</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
