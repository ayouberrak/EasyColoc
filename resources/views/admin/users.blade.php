    @extends('layouts.admin')

@section('title', 'Gestion des Utilisateurs')

@section('content')
<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="p-8 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-slate-800">Membres de la communauté</h3>
            <p class="text-sm text-slate-500 italic">Gérez les accès et surveillez le statut des utilisateurs.</p>
        </div>
        <div class="text-sm font-semibold text-slate-500">
            Total: {{ $users->count() }}
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-slate-600 text-xs font-bold uppercase tracking-wider">
                <tr>
                    <th class="px-8 py-4">Utilisateur</th>
                    <th class="px-8 py-4">Email</th>
                    <th class="px-8 py-4">Statut</th>
                    <th class="px-8 py-4">Inscrit le</th>
                    <th class="px-8 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50/50 transition-all">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <a href="{{ route('admin.users.show', $user) }}" class="font-bold text-slate-800 hover:text-blue-600 transition-colors">{{ $user->name }}</a>
                                @if($user->is_global_admin)
                                    <span class="text-[10px] bg-blue-100 text-blue-600 px-1.5 py-0.5 rounded-full uppercase font-black">Admin</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-slate-600 font-medium">{{ $user->email }}</td>
                    <td class="px-8 py-5">
                        @if($user->is_banned)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-600 border border-rose-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span>
                                Banni
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                Actif
                            </span>
                        @endif
                    </td>
                    <td class="px-8 py-5 text-slate-500 text-sm italic">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="px-8 py-5 text-right">
                        @if(!$user->is_global_admin)
                            @if($user->is_banned)
                                <form action="{{ route('admin.users.unban', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 bg-emerald-50 px-4 py-2 rounded-xl border border-emerald-100 transition-all">
                                        Débannir
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.ban', $user) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir bannir cet utilisateur ?')">
                                    @csrf
                                    <button type="submit" class="text-xs font-bold text-rose-600 hover:text-rose-700 bg-rose-50 px-4 py-2 rounded-xl border border-rose-100 transition-all shadow-sm hover:shadow">
                                        Bannir
                                    </button>
                                </form>
                            @endif
                        @else
                            <span class="text-xs font-bold text-slate-400 italic">Action restreinte</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="px-8 py-6 border-t border-slate-100">
    </div>
</div>
@endsection
