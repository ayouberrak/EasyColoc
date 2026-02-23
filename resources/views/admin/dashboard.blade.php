@extends('layouts.admin')

@section('title', 'Tableau de Bord')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Users Stat -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">Global</span>
        </div>
        <h3 class="text-slate-500 text-sm font-medium mb-1">Total Utilisateurs</h3>
        <p class="text-3xl font-bold text-slate-800">{{ $stats['users_count'] }}</p>
    </div>

    <!-- Colocations Stat -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl group-hover:bg-indigo-600 group-hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </div>
        </div>
        <h3 class="text-slate-500 text-sm font-medium mb-1">Colocations Actives</h3>
        <p class="text-3xl font-bold text-slate-800">{{ $stats['colocations_count'] }}</p>
    </div>

    <!-- Expenses Stat -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-rose-50 text-rose-600 rounded-2xl group-hover:bg-rose-600 group-hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <h3 class="text-slate-500 text-sm font-medium mb-1">Total Dépenses</h3>
        <p class="text-3xl font-bold text-slate-800">{{ number_format($stats['expenses_total'], 2) }} MAD</p>
    </div>

    <!-- Banned Users Stat -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-slate-100 text-slate-600 rounded-2xl group-hover:bg-slate-800 group-hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
            </div>
        </div>
        <h3 class="text-slate-500 text-sm font-medium mb-1">Utilisateurs Bannis</h3>
        <p class="text-3xl font-bold text-slate-800">{{ ($stats['banned_users_count']) }}</p>
    </div>
</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
    <h3 class="text-lg font-bold text-slate-800 mb-6">Aperçu de la Plateforme</h3>
    <div class="bg-blue-50 border border-blue-100 p-6 rounded-2xl text-blue-800">
        <p class="font-medium">Bienvenue dans l'interface de gestion EasyColoc.</p>
        <p class="text-sm mt-1 opacity-80">Ici, vous pouvez surveiller l'activité globale et gérer les membres de la communauté.</p>
    </div>
</div>
@endsection
