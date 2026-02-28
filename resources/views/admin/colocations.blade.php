@extends('layouts.admin')

@section('title', 'Gestion des Colocations')

@section('content')
<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden text-slate-800">
    <div class="p-8 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h3 class="text-xl font-bold">Liste des Colocations</h3>
            <p class="text-slate-500 text-sm mt-1">Aperçu de toutes les colocations créées sur la plateforme.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Statut:</span>
            <select class="text-sm border-slate-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                <option>Toutes</option>
                <option>Actives</option>
                <option>Archivées</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Colocation</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Propriétaire</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Membres</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Statut</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">

                @foreach($colocations as $coloc)
                <tr class="hover:bg-slate-50/50 transition-all group">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                                {{ substr($coloc->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-800">{{ $coloc->name }}</p>
                                <p class="text-xs text-slate-400">Créé le {{ $coloc->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="text-sm font-medium text-slate-600">{{ $coloc->owner->name}}</span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-2">
                             <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold">{{ $coloc->members_count }} membres</span>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 {{ $coloc->status === 'active' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }} rounded-full text-xs font-bold uppercase">
                            {{ $coloc->status }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <a href="{{ route('admin.colocations.show', $coloc->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-blue-600 hover:text-white text-slate-600 rounded-xl text-xs font-bold transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Voir
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
