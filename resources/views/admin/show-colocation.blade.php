@extends('layouts.admin')

@section('title', 'Détails de la Colocation')

@section('content')
<div class="space-y-8 text-slate-800">
    <!-- Header/Breadcrumb -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.colocations') }}" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-blue-600 hover:border-blue-200 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h3 class="text-2xl font-bold">{{ $colocation->name }}</h3>
            <p class="text-slate-500 text-sm">ID: #COLOC-{{ str_pad($colocation->id, 4, '0', STR_PAD_LEFT) }} • Créé le {{ $colocation->created_at->format('d F Y') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <h4 class="text-lg font-bold mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Informations Générales
                </h4>
                <div class="space-y-4">
                    <p class="text-slate-600 leading-relaxed">
                        {{ $colocation->description ?? "Aucune description fournie pour cette colocation." }}
                    </p>
                    <div class="grid grid-cols-2 gap-6 pt-4">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase">Statut</p>
                            <span class="mt-1 inline-block px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold italic uppercase">{{ $colocation->status }}</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase">Propriétaire</p>
                            <span class="mt-1 inline-block px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold">{{ $colocation->owner->name ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members List -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-100">
                    <h4 class="text-lg font-bold flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Membres de la Coloc ({{ $colocation->members->count() + 1 }})
                    </h4>
                </div>
                <div class="divide-y divide-slate-100">
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center font-bold text-slate-600">
                                {{ substr($colocation->owner->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold">{{ $colocation->owner->name }}</p>
                                <p class="text-xs text-slate-500">{{ $colocation->owner->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 {{ $colocation->owner->role === 'admin' ? 'bg-purple-50 text-purple-600' : 'bg-indigo-50 text-indigo-600' }} rounded-full text-[10px] font-black uppercase tracking-widest">
                                {{ $colocation->owner?->role ?? 'Owner' }}
                            </span>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold italic">Rejoint le {{ $colocation->owner->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    @forelse($colocation->members as $member)
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center font-bold text-slate-600">
                                {{ substr($member->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold">{{ $member->user->name }}</p>
                                <p class="text-xs text-slate-500">{{ $member->user->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 {{ $member->role === 'admin' ? 'bg-purple-50 text-purple-600' : 'bg-indigo-50 text-indigo-600' }} rounded-full text-[10px] font-black uppercase tracking-widest">
                                {{ $member->role }}
                            </span>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold italic">Rejoint le {{ $member->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-slate-400 italic">
                        Aucun membre pour le moment.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-8">
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6 italic">Statistiques Rapides</h4>
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500 text-sm">Invitations actives</span>
                        <span class="font-bold text-slate-800">Static</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500 text-sm">Token de la coloc</span>
                        <span class="font-mono text-xs bg-slate-50 px-2 py-1 rounded">{{ $colocation->token }}</span>
                    </div>
                </div>
                <hr class="my-6 border-slate-100">
                <button class="w-full py-4 bg-slate-800 hover:bg-black text-white rounded-2xl font-bold transition-all shadow-lg shadow-slate-200">
                    Modifier la Coloc
                </button>
            </div>

            <div class="bg-rose-50 p-8 rounded-3xl border border-rose-100">
                <h4 class="text-sm font-black text-rose-600 uppercase tracking-widest mb-4 italic">Zone de Danger</h4>
                <p class="text-xs text-rose-700 mb-6 opacity-80">La suppression ou l'archivage d'une colocation est irréversible.</p>
                <button class="w-full py-4 bg-white hover:bg-rose-100 text-rose-600 border border-rose-200 rounded-2xl font-bold transition-all">
                    Archiver la Colocation
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
