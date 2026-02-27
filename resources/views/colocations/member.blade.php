<x-app-layout>
    <!-- Sub-Navbar (Simple O Nadi) -->
    <div class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Sub-Navbar Links -->
                <div class="flex items-center space-x-10">
                    <a href="{{ route('dashboard', ['tab' => 'dashboard']) }}" 
                       class="relative py-5 text-xs font-bold uppercase tracking-widest transition-all {{ $tab === 'dashboard' ? 'text-blue-600' : 'text-slate-400 hover:text-slate-800' }}">
                        Balance
                        @if($tab === 'dashboard') <span class="absolute bottom-0 left-0 w-full h-1 bg-blue-600 rounded-t-full"></span> @endif
                    </a>
                    <a href="{{ route('dashboard', ['tab' => 'expenses']) }}" 
                       class="relative py-5 text-xs font-bold uppercase tracking-widest transition-all {{ $tab === 'expenses' ? 'text-blue-600' : 'text-slate-400 hover:text-slate-800' }}">
                        Dépenses
                        @if($tab === 'expenses') <span class="absolute bottom-0 left-0 w-full h-1 bg-blue-600 rounded-t-full"></span> @endif
                    </a>
                    <a href="{{ route('dashboard', ['tab' => 'members']) }}" 
                       class="relative py-5 text-xs font-bold uppercase tracking-widest transition-all {{ $tab === 'members' ? 'text-blue-600' : 'text-slate-400 hover:text-slate-800' }}">
                        Colocataires
                        @if($tab === 'members') <span class="absolute bottom-0 left-0 w-full h-1 bg-blue-600 rounded-t-full"></span> @endif
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-3">
                    <span class="px-3 py-1 bg-slate-50 text-slate-500 text-[9px] font-bold rounded-full border border-slate-100 uppercase tracking-widest italic">Membre Actif</span>
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[9px] font-bold rounded-full border border-blue-100 uppercase tracking-widest italic">Propriétaire: {{ $colocation->owner->name }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 animate-fade-in">
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            <span class="text-sm font-semibold">{{ session('success') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 animate-fade-in">
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span class="text-sm font-semibold">{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if($tab === 'dashboard')
                @include('colocations.partials.member.dashboard')
            @elseif($tab === 'expenses')
                @include('colocations.partials.member.expenses')
            @elseif($tab === 'members')
                @include('colocations.partials.member.members')
            @endif

        </div>
    </div>
</x-app-layout>
