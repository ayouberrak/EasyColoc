<nav x-data="{ open: false, atTop: true }" 
     @scroll.window="atTop = (window.pageYOffset > 10 ? false : true)"
     :class="{ 'glass-nav shadow-lg': !atTop || open, 'bg-transparent': atTop && !open }"
     class="fixed w-full z-50 transition-all duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center group">
                        <x-application-logo class="block h-10 w-auto fill-current text-blue-600 group-hover:scale-110 transition" />
                        <span class="ml-3 text-2xl font-bold text-slate-800 tracking-tight">EasyColoc</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-12 sm:flex h-20 items-center">
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">Home</a>
                    <a href="{{ route('home') }}#features" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">Comment ça marche</a>

                    @guest
                        <x-nav-link :href="route('colocations.create')" :active="request()->routeIs('colocations.create')" class="text-sm font-semibold">
                            {{ __('New Colocation') }}
                        </x-nav-link>
                    @endguest

                    @auth
                        @if(Auth::user()->is_global_admin)
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-sm font-semibold">
                                {{ __('Admin Panel') }}
                            </x-nav-link>
                        @endif


                        @if(Auth::user()->activeMember && !Auth::user()->isOwner())
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-sm font-semibold">
                                {{ __('My Colocation') }}
                            </x-nav-link>
                        @endif

                        @if(Auth::user()->isOwner())
                            <x-nav-link :href="route('owner.dashboard')" :active="request()->routeIs('owner.dashboard')" class="text-sm font-semibold">
                                {{ __('Tableau de bord') }}
                            </x-nav-link>
                        @endif

                        @if(!Auth::user()->activeMember && !Auth::user()->isOwner())
                            <x-nav-link :href="route('colocations.create')" :active="request()->routeIs('colocations.create')" class="text-sm font-semibold">
                                {{ __('New Colocation') }}
                            </x-nav-link>
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
                                <button class="inline-flex items-center px-4 py-2 border border-slate-200 text-sm font-bold rounded-xl text-slate-700 bg-white hover:bg-slate-50 hover:border-slate-300 focus:outline-none transition-all shadow-sm">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-2 font-black">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-2">
                                        <svg class="fill-current h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-3 border-b border-slate-100">
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Compte</p>
                                    <p class="text-sm font-semibold text-slate-900 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <x-dropdown-link :href="route('profile.edit')" class="font-medium text-slate-700 hover:bg-slate-50">
                                    {{ __('Mon profil') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            class="font-medium text-red-600 hover:bg-red-50"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Se déconnecter') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">Connexion</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-full hover:bg-blue-700 transition shadow-lg shadow-blue-100">S'inscrire</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-slate-100 animate-fade-in shadow-xl">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('home') }}#features">Comment ça marche</x-responsive-nav-link>

            @guest
                <x-responsive-nav-link :href="route('colocations.create')" :active="request()->routeIs('colocations.create')">
                    {{ __('New Colocation') }}
                </x-responsive-nav-link>
            @endguest

            @auth
                @if(Auth::user()->is_global_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Admin Panel') }}
                    </x-responsive-nav-link>
                @endif

                @if(Auth::user()->activeMember && !Auth::user()->isOwner())
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('My Colocation') }}
                    </x-responsive-nav-link>
                @endif

                @if(Auth::user()->isOwner())
                    <x-responsive-nav-link :href="route('owner.dashboard')" :active="request()->routeIs('owner.dashboard')">
                        {{ __('Tableau de bord') }}
                    </x-responsive-nav-link>
                @endif

                @if(!Auth::user()->activeMember && !Auth::user()->isOwner())
                    <x-responsive-nav-link :href="route('colocations.create')" :active="request()->routeIs('colocations.create')">
                        {{ __('New Colocation') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-100">
            @auth
                <div class="px-4 py-3 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3 font-black text-lg">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-bold text-slate-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-slate-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="font-semibold text-slate-700">
                        {{ __('Mon profil') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                class="font-semibold text-red-600"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Se déconnecter') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1 px-4 pb-4">
                    <a href="{{ route('login') }}" class="block text-base font-bold text-slate-600 py-2">Connexion</a>
                    <a href="{{ route('register') }}" class="block text-base font-bold text-blue-600 py-2">S'inscrire</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
