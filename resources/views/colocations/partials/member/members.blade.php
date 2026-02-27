<div class="animate-fade-in space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight leading-tight">La Tribu <span class="text-blue-600">{{ $colocation->name }}</span></h1>
            <p class="text-slate-500 font-medium mt-1">Gérez et visualisez l'intégrité de votre équipe.</p>
        </div>
        <div class="flex items-center -space-x-3 overflow-hidden">
            @foreach($colocation->members->take(5) as $m)
                <div class="w-12 h-12 rounded-2xl border-4 border-white bg-slate-100 flex items-center justify-center font-black text-slate-600 shadow-sm">
                    {{ substr($m->user->name, 0, 1) }}
                </div>
            @endforeach
            @if($colocation->members->count() > 5)
                <div class="w-12 h-12 rounded-2xl border-4 border-white bg-slate-900 flex items-center justify-center font-black text-white text-xs shadow-sm">
                    +{{ $colocation->members->count() - 5 }}
                </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        @foreach($colocation->members as $member)
            @php 
                $isOwner = $member->user_id === $colocation->user_id;
                $isMe = $member->user_id === Auth::id();
            @endphp
            <div class="group relative bg-white border border-slate-100 p-8 rounded-[2.5rem] transition-all duration-500 hover:shadow-2xl hover:shadow-blue-200/40 hover:-translate-y-1">
                <div class="absolute top-6 right-6">
                    @if($isMe)
                        <span class="px-3 py-1 bg-blue-600 text-white text-[10px] font-black rounded-lg uppercase tracking-widest shadow-lg shadow-blue-200">Moi</span>
                    @endif
                </div>

                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-6">
                        <div class="w-28 h-28 bg-slate-900 rounded-[2.5rem] flex items-center justify-center text-white text-4xl font-black shadow-2xl group-hover:scale-105 group-hover:-rotate-3 transition-all duration-500">
                            {{ substr($member->user->name, 0, 1) }}
                        </div>
                        <div class="absolute -bottom-2 -right-2 flex items-center gap-1.5 px-3 py-1.5 bg-amber-400 text-white text-[11px] font-black rounded-2xl shadow-xl border-4 border-white ring-1 ring-amber-100">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                            {{ $member->reputation ?? 0 }}
                        </div>
                    </div>

                    <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-2 group-hover:text-blue-600 transition-colors">{{ $member->user->name }}</h3>
                    
                    <div class="flex items-center gap-2.5 mb-8">
                        @if($isOwner)
                            <div class="flex items-center gap-1.5 px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black rounded-lg uppercase tracking-widest border border-indigo-100">
                                <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-pulse"></span>
                                Propriétaire
                            </div>
                        @else
                            <div class="flex items-center gap-1.5 px-3 py-1 bg-slate-50 text-slate-400 text-[10px] font-black rounded-lg uppercase tracking-widest border border-slate-100">
                                Colocataire
                            </div>
                        @endif
                    </div>

                    <div class="w-full grid grid-cols-2 gap-4 pt-8 border-t border-slate-50">
                        <div class="text-left">
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Inscrit en</p>
                            <p class="text-sm font-bold text-slate-900">{{ $member->created_at ? date('M Y', strtotime($member->created_at)) : '...' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Status</p>
                            <div class="flex items-center justify-end gap-1.5">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                <span class="text-sm font-bold text-emerald-600">Sain</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
