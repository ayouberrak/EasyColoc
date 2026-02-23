<x-auth-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-800 mb-2">Bon retour !</h2>
        <p class="text-slate-500 italic">Heureux de vous revoir sur EasyColoc.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-semibold mb-2" />
            <div class="relative">
                <input id="email" 
                       class="auth-input block w-full px-4 py-3 rounded-xl bg-slate-50/50 border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none" 
                       type="email" 
                       name="email" 
                       placeholder="votre@email.com"
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <div class="flex items-center justify-between mb-2">
                <x-input-label for="password" :value="__('Mot de passe')" class="text-slate-700 font-semibold" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-blue-600 hover:text-blue-700" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
            <input id="password" 
                   class="auth-input block w-full px-4 py-3 rounded-xl bg-slate-50/50 border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none"
                   type="password"
                   name="password"
                   placeholder="••••••••"
                   required 
                   autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mb-8">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-md border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 transition-all cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-slate-600">Se souvenir de moi</span>
            </label>
        </div>

        <button type="submit" class="auth-btn-primary w-full py-4 rounded-2xl text-lg mb-6">
            Se connecter
        </button>

        <div class="relative mb-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-slate-500">Ou continuer avec</span>
            </div>
        </div>

        <button type="button" class="auth-btn-social w-full py-3 rounded-xl flex items-center justify-center gap-3 font-semibold mb-8">
            <svg class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Google
        </button>

        <p class="text-center text-slate-600">
            Nouveau ici ? 
            <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">
                Créer un compte
            </a>
        </p>
    </form>
</x-auth-layout>
