<!-- TAB: MEMBERS MANAGEMENT -->
<div class="animate-fade-in space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Ma Tribu</h2>
            <p class="text-slate-500 font-medium text-sm">Invitez et gérez les membres de votre colocation.</p>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Add Member -->
        <div class="card-simple">
            <h3 class="text-lg font-bold text-slate-900 mb-1">Ajouter un membre</h3>
            <p class="text-xs text-slate-400 mb-6">Rechercher par nom ou email</p>
            
            <form action="{{ route('owner.dashboard') }}" method="GET" class="space-y-4 mb-6">
                <input type="hidden" name="tab" value="members">
                <div class="relative">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Ex: Sara..." class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-medium text-sm">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>
                </div>
            </form>

            <div class="space-y-3 max-h-[300px] overflow-y-auto pr-1">
                @forelse($potentialMembers as $pMember)
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center font-bold text-slate-700 text-xs">
                                {{ substr($pMember->name, 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-slate-900 truncate">{{ $pMember->name }}</p>
                                <p class="text-[10px] text-slate-400 truncate">{{ $pMember->email }}</p>
                            </div>
                        </div>
                        <form action="{{ route('colocations.invite') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $pMember->email }}">
                            <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                            <button type="submit" class="px-3 py-1.5 bg-blue-600 text-white text-[10px] font-bold rounded-lg hover:bg-blue-700 transition-colors">
                                Inviter
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-center py-4 text-slate-400 text-xs font-medium">
                        {{ $search ? 'Aucun utilisateur trouvé' : 'Commencez à taper pour rechercher' }}
                    </p>
                @endforelse
            </div>
        </div>

        <!-- Members List -->
        <div class="card-simple">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Membres Actuels</h3>
            <div class="space-y-4">
                @foreach($activeMembers as $member)
                    <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-slate-100 hover:border-blue-100 transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-slate-50 rounded-lg flex items-center justify-center font-bold text-slate-700 text-sm">
                                {{ substr($member->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900 flex items-center gap-2">
                                    {{ $member->user->name }}
                                    <span class="flex items-center gap-1 px-1.5 py-0.5 bg-amber-50 text-amber-600 text-[8px] font-black rounded-md border border-amber-100 shadow-sm shadow-amber-50/50">
                                        <svg class="w-2 h-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                        {{ $member->user->reputation ?? 0 }}
                                    </span>
                                </p>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest leading-none mt-1">Rejoint le {{ $member->created_at ? $member->created_at->format('d M') : '...' }}</p>
                            </div>
                        </div>
                        @if($member->user_id === $colocation->user_id)
                            <span class="px-2 py-0.5 bg-blue-50 text-blue-600 text-[9px] font-bold rounded uppercase">Proprio</span>
                        @else
                            <div class="flex items-center gap-2">
                                <form action="{{ route('colocations.transfer-ownership', $member) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment transférer la propriété à {{ $member->user->name }} ? Vous perdrez vos privilèges de gestion.')">
                                    @csrf
                                    <button type="submit" class="text-slate-300 hover:text-amber-500 transition-colors" title="Transférer la propriété (Taje)">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('colocations.owner.remove', $member) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer {{ $member->user->name }} de la colocation ?')">
                                        @csrf
                                        <button class="text-slate-300 hover:text-red-500 transition-colors" onclick="return confirm('Voulez-vous vraiment supprimer {{ $member->user->name }} de la colocation ?')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach

                @foreach($pendingInvitations as $invitation)
                    <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-dashed border-slate-200">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-slate-50 rounded-lg flex items-center justify-center text-slate-300 italic">?</div>
                            <div>
                                <p class="text-sm font-bold text-slate-700 truncate max-w-[150px]">{{ $invitation->email }}</p>
                                <p class="text-[9px] text-orange-500 font-bold uppercase tracking-widest">En attente</p>
                            </div>
                        </div>
                        <button class="text-[9px] font-bold text-slate-400 hover:text-red-500 uppercase">Annuler</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
