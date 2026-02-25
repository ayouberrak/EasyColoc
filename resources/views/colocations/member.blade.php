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
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
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
