<div class="animate-fade-in space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Mes Paiements</h2>
            <p class="text-slate-500 font-medium mt-1">Consultez et réglez vos dettes envers vos colocataires.</p>
        </div>
        <div class="hidden md:flex items-center gap-3">
            <div class="px-4 py-2 bg-white rounded-2xl border border-slate-100 shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total à payer</p>
                <p class="text-lg font-black text-red-600">{{ number_format($userDebts->sum('amount'), 2) }} DH</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Debts List -->
        <div class="space-y-6">
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Dettes en cours</h3>
                    <span class="px-3 py-1 bg-red-50 text-red-600 text-[10px] font-bold rounded-full border border-red-100 uppercase tracking-widest italic">
                        {{ $userDebts->count() }} @if($userDebts->count() > 1) Dettes @else Dette @endif
                    </span>
                </div>

                <div class="divide-y divide-slate-50">
                    @forelse($userDebts as $debt)
                        <div class="p-8 hover:bg-slate-50/50 transition-all group">
                            <div class="flex items-center justify-between gap-6">
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition-all shadow-inner">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-lg font-black text-slate-900 leading-tight">Dette envers <span class="text-blue-600">{{ $debt->creditor->name }}</span></p>
                                        <p class="text-sm font-medium text-slate-500 mt-0.5">Réglez cette dette pour mettre à jour la balance.</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-black text-slate-900 tracking-tight">{{ number_format($debt->amount, 2) }} DH</p>
                                    <form action="{{ route('payment.store') }}" method="POST" class="mt-3">
                                        @csrf
                                        <input type="hidden" name="credit_id" value="{{ $debt->id }}">
                                        <button type="submit" 
                                                class="px-6 py-2.5 bg-blue-600 text-white text-[11px] font-black rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 uppercase tracking-widest active:scale-95">
                                            Régler
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-16 text-center">
                            <div class="w-20 h-20 bg-green-50 rounded-3xl flex items-center justify-center text-green-500 mx-auto mb-6">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Aucune dette !</h3>
                            <p class="text-slate-500 font-medium mt-2">Vous êtes à jour dans vos paiements.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Info / Tips Section -->
        <div class="space-y-6">
            <div class="bg-slate-900 rounded-[2rem] p-8 text-white relative overflow-hidden group shadow-2xl">
                <div class="relative z-10">
                    <h3 class="text-xl font-black tracking-tight mb-4">Comment ça marche ?</h3>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="w-8 h-8 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 font-bold text-blue-400">1</div>
                            <p class="text-sm text-slate-300 font-medium">Consultez vos dettes calculées automatiquement en fonction des dépenses partagées.</p>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-8 h-8 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 font-bold text-blue-400">2</div>
                            <p class="text-sm text-slate-300 font-medium">Remboursez votre colocataire en personne ou par virement bancaire.</p>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-8 h-8 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 font-bold text-blue-400">3</div>
                            <p class="text-sm text-slate-300 font-medium">Cliquez sur <span class="text-white font-bold uppercase tracking-widest text-[10px]">Régler</span> pour confirmer le paiement et l'effacer de vos dettes.</p>
                        </div>
                    </div>
                </div>
                <!-- Abstract Design Decor -->
                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-blue-600/20 rounded-full blur-3xl transition-all group-hover:scale-110"></div>
                <div class="absolute -left-10 -top-10 w-32 h-32 bg-indigo-600/10 rounded-full blur-2xl transition-all group-hover:scale-110"></div>
            </div>

            <div class="bg-white rounded-[2rem] border border-slate-100 p-8 shadow-sm">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-10 h-10 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                    <h4 class="font-black text-slate-900">Rappel Important</h4>
                </div>
                <p class="text-sm text-slate-500 font-medium leading-relaxed">
                    Assurez-vous d'avoir réellement effectué le paiement avant de cliquer sur "Régler". Cette action est irréversible et mettra à jour instantanément la balance de la colocation.
                </p>
            </div>
        </div>
    </div>
</div>
