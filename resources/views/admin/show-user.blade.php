@extends('layouts.admin')

@section('title', 'Détails de l\'utilisateur')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden p-8">
        <div class="flex items-center gap-6">
            <div class="w-20 h-20 rounded-2xl bg-slate-100 flex items-center justify-center font-bold text-slate-500 text-3xl shadow-inner">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ $user->name }}</h1>
                    @if($user->is_global_admin)
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-[10px] font-black rounded-full uppercase tracking-widest border border-blue-200">Admin Global</span>
                    @endif
                </div>
                <p class="text-slate-500 font-medium mt-1">{{ $user->email }}</p>
                <div class="flex items-center gap-4 mt-4">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Inscrit le</span>
                        <span class="text-sm font-bold text-slate-700">{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="w-px h-8 bg-slate-100"></div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Statut</span>
                        @if($user->is_banned)
                            <span class="text-xs font-bold text-rose-600">Banni</span>
                        @else
                            <span class="text-xs font-bold text-emerald-600">Actif</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                @if(!$user->is_global_admin)
                    @if($user->is_banned)
                        <form action="{{ route('admin.users.unban', $user) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-2.5 bg-emerald-50 text-emerald-600 text-xs font-black rounded-xl border border-emerald-100 hover:bg-emerald-600 hover:text-white transition-all">
                                Débannir l'utilisateur
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.users.ban', $user) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
                            @csrf
                            <button type="submit" class="px-6 py-2.5 bg-rose-50 text-rose-600 text-xs font-black rounded-xl border border-rose-100 hover:bg-rose-600 hover:text-white transition-all">
                                Bannir l'utilisateur
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">Historique des Colocations</h3>
            <p class="text-sm text-slate-500 font-medium">Liste de toutes les colocations rejointes ou gérées par cet utilisateur.</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-slate-500 text-[10px] font-black uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-4">Colocation</th>
                        <th class="px-8 py-4">Rôle</th>
                        <th class="px-8 py-4">Propriétaire</th>
                        <th class="px-8 py-4">Période</th>
                        <th class="px-8 py-4">Status du Membre</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($memberships as $membership)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center font-black text-slate-400 group-hover:text-blue-600 transition-colors">
                                    {{ substr($membership->colocation->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900">{{ $membership->colocation->name }}</div>
                                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">ID: {{ $membership->colocation->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            @if($membership->role === 'owner')
                                <span class="px-2 py-0.5 bg-amber-50 text-amber-600 text-[9px] font-black rounded-md uppercase tracking-widest border border-amber-100">Propriétaire</span>
                            @else
                                <span class="px-2 py-0.5 bg-blue-50 text-blue-600 text-[9px] font-black rounded-md uppercase tracking-widest border border-blue-100">Membre</span>
                            @endif
                        </td>
                        <td class="px-8 py-5 text-slate-600 font-bold text-sm">
                            {{ $membership->colocation->owner->name }}
                        </td>
                        <td class="px-8 py-5">
                            <div class="text-xs font-bold text-slate-700">Du {{ $membership->created_at->format('d/m/Y') }}</div>
                            @if($membership->left_at)
                                <div class="text-[10px] text-slate-400 font-bold italic">jusqu'au {{ $membership->left_at->format('d/m/Y') }}</div>
                            @else
                                <div class="text-[10px] text-emerald-500 font-bold italic">En cours</div>
                            @endif
                        </td>
                        <td class="px-8 py-5">
                            @if($membership->left_at)
                                <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-black rounded-lg uppercase tracking-widest">A quitté</span>
                            @else
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-lg uppercase tracking-widest">Actif</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center">
                            <div class="text-slate-400 italic text-sm font-medium">Cet utilisateur n'a rejoint aucune colocation.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
