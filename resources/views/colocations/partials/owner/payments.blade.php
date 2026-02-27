<!-- TAB: PAYMENTS (SIMPLE O NADI STYLE) -->
<div class="animate-fade-in space-y-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Gestion des Paiements</h2>
        <p class="text-slate-500 font-medium text-sm">Solder les dettes de vos colocataires simplement.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($colocation->members as $member)
            @php 
                $memberCredits = $debts->where('debtor_id', $member->user_id);
                $totalOwed = $memberCredits->sum('amount');
            @endphp

            <!-- MEMBER CARD (SIMPLE) -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col h-full overflow-hidden">
                
                <!-- Header (Minimal) -->
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-xl font-bold text-indigo-600 border border-slate-100">
                            {{ substr($member->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900 tracking-tight">
                                {{ $member->user->name }}
                                @if($member->user_id === Auth::id())
                                    <span class="ml-1 text-[10px] bg-indigo-50 text-indigo-600 px-2 py-0.5 rounded-full uppercase tracking-widest font-black">Moi</span>
                                @endif
                            </h4>
                            <div class="flex gap-1 mt-1">
                                @for($i = 0; $i < 3; $i++)
                                    <div class="w-1.5 h-1.5 rounded-full {{ $i < $memberCredits->count() ? 'bg-yellow-400' : 'bg-slate-200' }}"></div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CREDITS LIST -->
                <div class="p-6 flex-1 space-y-3">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">Dettes à régler</p>
                    
                    @forelse($memberCredits as $credit)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl border border-slate-100 group/item">
                            <div>
                                <div class="flex items-center gap-1.5">
                                    <p class="text-sm font-bold text-slate-900">{{ number_format($credit->amount, 2) }} DH</p>
                                    <span class="text-[9px] text-slate-400 font-bold uppercase">→ {{ $credit->creditor_id === Auth::id() ? 'Moi' : $credit->creditor->name }}</span>
                                </div>
                                <p class="text-[9px] font-medium text-slate-500 uppercase">{{ $credit->created_at->diffForHumans() }}</p>
                            </div>

                            <form action="{{ route('payment.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="credit_id" value="{{ $credit->id }}">
                                <input type="hidden" name="method" value="cash">
                                <button type="submit" class="px-3 py-1.5 bg-white hover:bg-slate-900 hover:text-white text-indigo-600 text-[10px] font-bold rounded-lg border border-slate-200 transition-all active:scale-95 shadow-sm">
                                    Mask as Payee
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="py-6 text-center">
                            <p class="text-[10px] font-bold text-slate-300 uppercase italic">À jour</p>
                        </div>
                    @endforelse
                </div>

                <!-- TOTAL FOOTER -->
                <div class="p-6 bg-slate-50/50 border-t border-slate-50 flex items-center justify-between mt-auto">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total</span>
                    <span class="text-lg font-bold text-slate-900">{{ number_format($totalOwed, 2) }} <span class="text-xs opacity-50">DH</span></span>
                </div>
            </div>
        @endforeach
    </div>
</div>
