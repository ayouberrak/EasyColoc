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
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="font-bold text-slate-900">Historique récent</h3>
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
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-[9px] font-bold text-slate-400 uppercase">{{ \Carbon\Carbon::parse($expense->date)->format('d M') }}</span>
                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                        <span class="text-[9px] font-bold text-blue-600 uppercase">{{ $expense->payer->name }}</span>
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
