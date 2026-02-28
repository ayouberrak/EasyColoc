<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Gestion des Catégories</h2>
                <p class="text-slate-500 font-medium">Personnalisez les catégories de dépenses pour votre colocation.</p>
            </div>
            <button onclick="document.getElementById('add-category-modal').classList.remove('hidden')" 
                    class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white text-sm font-black rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 uppercase tracking-widest">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Nouvelle Catégorie
            </button>
        </div>
    </div>

    <!-- Categories List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm group hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900">{{ $category->name }}</h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                @if($category->colocation_id)
                                    Personnalisée
                                @else
                                    Standard
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    @if($category->colocation_id)
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Supprimer cette catégorie ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-slate-300 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add Category Modal -->
    <div id="add-category-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-900/40 backdrop-blur-sm" onclick="document.getElementById('add-category-modal').classList.add('hidden')"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-3xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('categories.store') }}" method="POST" class="p-8">
                    @csrf
                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                    
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-900">Ajouter une catégorie</h3>
                        <p class="text-sm text-slate-500 mt-1">Donnez un nom à votre nouvelle catégorie de dépense.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 ml-1" for="name">Nom de la catégorie</label>
                            <input type="text" name="name" id="name" required
                                   class="w-full px-4 py-3 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-slate-900 font-semibold"
                                   placeholder="ex: Courses, Internet, Electricité...">
                        </div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <button type="button" onclick="document.getElementById('add-category-modal').classList.add('hidden')"
                                class="flex-1 px-6 py-3 bg-slate-100 text-slate-600 text-sm font-black rounded-2xl hover:bg-slate-200 transition-all uppercase tracking-widest">
                            Annuler
                        </button>
                        <button type="submit"
                                class="flex-1 px-6 py-3 bg-blue-600 text-white text-sm font-black rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 uppercase tracking-widest">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
