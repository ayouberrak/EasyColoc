<nav x-data="{ open: false }" class="nav-simple">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center group">
                        <div class="h-9 w-9 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold transition-transform group-hover:scale-105">
                            <x-application-logo class="h-5 w-auto fill-current" />
                        </div>
                        <span class="ml-2.5 text-xl font-bold text-slate-900 tracking-tight">EasyColoc</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-slate-600 hover:text-blue-600 px-3 py-2 rounded-md {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">Home</a>
                    <a href="{{ route('home') }}#features" class="text-sm font-semibold text-slate-600 hover:text-blue-600 px-3 py-2 rounded-md">Comment ça marche</a>

                    @auth
                        @if(Auth::user()->is_global_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-blue-600' }} px-3 py-2 rounded-md transition-all">
                                {{ __('Admin Panel') }}
                            </a>
                        @endif

                        @if(Auth::user()->activeMember && !Auth::user()->isOwner())
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold {{ request()->routeIs('dashboard') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-blue-600' }} px-3 py-2 rounded-md transition-all">
                                {{ __('My Colocation') }}
                            </a>
                        @endif

                        @if(Auth::user()->isOwner())
                            <a href="{{ route('owner.dashboard') }}" class="text-sm font-semibold {{ request()->routeIs('owner.dashboard') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-blue-600' }} px-3 py-2 rounded-md transition-all">
                                {{ __('Tableau de bord') }}
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown / Guest Links -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-1.5 border border-slate-200 text-sm font-semibold rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition-all">
                                    <div class="w-7 h-7 rounded-md bg-blue-600 text-white flex items-center justify-center mr-2 font-bold text-xs">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <div class="max-w-[100px] truncate">{{ Auth::user()->name }}</div>
                                    <svg class="ms-1.5 h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-3 border-b border-slate-100 bg-slate-50/50">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Connecté en tant que</p>
                                    <p class="text-xs font-semibold text-slate-900 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="p-1">
                                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        {{ __('Mon profil') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-red-600 hover:bg-red-50 transition-all"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                            {{ __('Se déconnecter') }}
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Connexion</a>
                        <a href="{{ route('register') }}" class="px-5 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">S'inscrire</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-blue-600 hover:bg-slate-50 focus:outline-none transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="sm:hidden bg-white border-b border-slate-200">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-semibold text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition-all">Home</a>
            <a href="{{ route('home') }}#features" class="block px-3 py-2 rounded-md text-base font-semibold text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition-all">Comment ça marche</a>

            @auth
                @if(Auth::user()->is_global_admin)
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' }} transition-all">
                        {{ __('Admin Panel') }}
                    </a>
                @endif

                @if(Auth::user()->activeMember && !Auth::user()->isOwner())
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-semibold {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' }} transition-all">
                        {{ __('My Colocation') }}
                    </a>
                @endif

                @if(Auth::user()->isOwner())
                    <a href="{{ route('owner.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-semibold {{ request()->routeIs('owner.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' }} transition-all">
                        {{ __('Tableau de bord') }}
                    </a>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-6 border-t border-slate-200 bg-slate-50/50 px-4">
            @auth
                <div class="flex items-center px-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-blue-600 text-white flex items-center justify-center mr-3 font-bold text-lg">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-bold text-slate-900 text-base leading-tight">{{ Auth::user()->name }}</div>
                        <div class="text-xs font-medium text-slate-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="space-y-1">
                    <a href="{{ route('profile.edit')}}" class="block px-3 py-2 rounded-md text-base font-semibold text-slate-700 hover:bg-white transition-all">
                        {{ __('Mon profil') }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-semibold text-red-600 hover:bg-red-50 transition-all">
                            {{ __('Se déconnecter') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="grid grid-cols-2 gap-3 px-3">
                    <a href="{{ route('login') }}" class="flex justify-center items-center py-2.5 rounded-lg text-sm font-semibold text-slate-700 bg-white border border-slate-200 transition-all">Connexion</a>
                    <a href="{{ route('register') }}" class="flex justify-center items-center py-2.5 rounded-lg text-sm font-semibold text-white bg-blue-600 transition-all">S'inscrire</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

