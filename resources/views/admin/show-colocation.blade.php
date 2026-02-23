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
            <h3 class="text-2xl font-bold">Villa Sunshine</h3>
            <p class="text-slate-500 text-sm">ID: #COLOC-00{{ $id }} • Créé le 23 Février 2026</p>
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
                        Cette colocation située dans le quartier résidentiel offre un cadre de vie exceptionnel pour les jeunes professionnels. Entièrement meublée et équipée avec des installations modernes.
                    </p>
                    <div class="grid grid-cols-2 gap-6 pt-4">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase">Statut</p>
                            <span class="mt-1 inline-block px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold italic">Actif</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase">Visibilité</p>
                            <span class="mt-1 inline-block px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold">Publique</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members List -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-100">
                    <h4 class="text-lg font-bold flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Membres de la Coloc (4)
                    </h4>
                </div>
                <div class="divide-y divide-slate-100">
                    @php
                        $dummyMembers = [
                            ['name' => 'Ayoub Errak', 'role' => 'Propriétaire', 'email' => 'ayoub@example.com', 'joined' => '23 Feb 2026'],
                            ['name' => 'Karim Ben', 'role' => 'Colocataire', 'email' => 'karim@example.com', 'joined' => '24 Feb 2026'],
                            ['name' => 'Sarah Connor', 'role' => 'Colocataire', 'email' => 'sarah@example.com', 'joined' => '25 Feb 2026'],
                            ['name' => 'John Doe', 'role' => 'En attente', 'email' => 'john@example.com', 'joined' => '26 Feb 2026'],
                        ];
                    @endphp
                    @foreach($dummyMembers as $member)
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center font-bold text-slate-600">
                                {{ substr($member['name'], 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold">{{ $member['name'] }}</p>
                                <p class="text-xs text-slate-500">{{ $member['email'] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 {{ $member['role'] === 'Propriétaire' ? 'bg-purple-50 text-purple-600' : ($member['role'] === 'Colocataire' ? 'bg-indigo-50 text-indigo-600' : 'bg-amber-50 text-amber-600') }} rounded-full text-[10px] font-black uppercase tracking-widest">
                                {{ $member['role'] }}
                            </span>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold italic">Depuis le {{ $member['joined'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-8">
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6 italic">Statistiques Rapides</h4>
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500 text-sm">Dépenses ce mois</span>
                        <span class="font-bold text-slate-800">2,450 MAD</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500 text-sm">Invitations actives</span>
                        <span class="font-bold text-slate-800">2</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500 text-sm">Taux d'occupation</span>
                        <span class="font-bold text-slate-800">80%</span>
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
