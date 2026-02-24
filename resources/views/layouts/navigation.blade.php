<nav x-data="{ open: false, atTop: true }" 
     @scroll.window="atTop = (window.pageYOffset > 20 ? false : true)"
     :class="{ 'glass-nav shadow-lg py-2': !atTop || open, 'bg-transparent py-4': atTop && !open }"
     class="fixed w-full z-50 transition-all duration-500">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center group">
                        <div class="h-10 w-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <x-application-logo class="h-6 w-auto fill-current text-white" />
                        </div>
                        <span class="ml-3 text-2xl font-black text-slate-900 tracking-tight font-heading">EasyColoc</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('home') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition-colors px-3 py-2 rounded-lg hover:bg-blue-50/50">Home</a>
                    <a href="{{ route('home') }}#features" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition-colors px-3 py-2 rounded-lg hover:bg-blue-50/50">Comment ça marche</a>

                    @auth
                        @if(Auth::user()->is_global_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-blue-600' }} px-3 py-2 rounded-xl transition-all">
                                {{ __('Admin Panel') }}
                            </a>
                        @endif

                        @if(Auth::user()->activeMember && !Auth::user()->isOwner())
                            <a href="{{ route('dashboard') }}" class="text-sm font-bold {{ request()->routeIs('dashboard') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-blue-600' }} px-3 py-2 rounded-xl transition-all">
                                {{ __('My Colocation') }}
                            </a>
                        @endif

                        @if(Auth::user()->isOwner())
                            <a href="{{ route('owner.dashboard') }}" class="text-sm font-bold {{ request()->routeIs('owner.dashboard') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-blue-600' }} px-3 py-2 rounded-xl transition-all">
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
                        <x-dropdown align="right" width="56">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-4 py-2 border border-slate-200 text-sm font-bold rounded-2xl text-slate-700 bg-white hover:bg-slate-50 hover:border-blue-200 focus:outline-none transition-all shadow-sm group">
                                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center mr-3 font-black shadow-md shadow-blue-100 group-hover:scale-105 transition-transform">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <div class="max-w-[120px] truncate">{{ Auth::user()->name }}</div>
                                    <svg class="ms-2 h-4 w-4 text-slate-400 group-hover:translate-y-0.5 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Connecté en tant que</p>
                                    <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="p-2">
                                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        {{ __('Mon profil') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-red-600 hover:bg-red-50 transition-all"
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
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition px-4 py-2">Connexion</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-2xl hover:bg-blue-700 transition shadow-lg shadow-blue-200 transform hover:-translate-y-0.5 active:scale-95">S'inscrire</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-blue-600 hover:bg-blue-50 focus:outline-none transition-all">
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
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="sm:hidden bg-white/95 backdrop-blur-xl border-b border-slate-100 shadow-2xl">
        <div class="pt-4 pb-3 space-y-2 px-4">
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-2xl text-base font-bold text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-all">Home</a>
            <a href="{{ route('home') }}#features" class="block px-4 py-3 rounded-2xl text-base font-bold text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-all">Comment ça marche</a>

            @auth
                @if(Auth::user()->is_global_admin)
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-2xl text-base font-bold {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-blue-50' }} transition-all">
                        {{ __('Admin Panel') }}
                    </a>
                @endif

                @if(Auth::user()->activeMember && !Auth::user()->isOwner())
                    <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-2xl text-base font-bold {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-blue-50' }} transition-all">
                        {{ __('My Colocation') }}
                    </a>
                @endif

                @if(Auth::user()->isOwner())
                    <a href="{{ route('owner.dashboard') }}" class="block px-4 py-3 rounded-2xl text-base font-bold {{ request()->routeIs('owner.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-blue-50' }} transition-all">
                        {{ __('Tableau de bord') }}
                    </a>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-6 border-t border-slate-100 bg-slate-50/50 px-4">
            @auth
                <div class="flex items-center px-4 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center mr-4 font-black text-xl shadow-lg shadow-blue-100">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-black text-slate-900 text-lg leading-tight">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-semibold text-slate-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="space-y-2">
                    <a href="{{ route('profile.edit')}}" class="block px-4 py-3 rounded-2xl text-base font-bold text-slate-800 hover:bg-white transition-all">
                        {{ __('Mon profil') }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 rounded-2xl text-base font-bold text-red-600 hover:bg-red-50 transition-all">
                            {{ __('Se déconnecter') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="grid grid-cols-2 gap-4 px-4">
                    <a href="{{ route('login') }}" class="flex justify-center items-center py-3 rounded-2xl text-base font-bold text-slate-700 bg-white border border-slate-200 transition-all">Connexion</a>
                    <a href="{{ route('register') }}" class="flex justify-center items-center py-3 rounded-2xl text-base font-bold text-white bg-blue-600 shadow-lg shadow-blue-100 transition-all">S'inscrire</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

