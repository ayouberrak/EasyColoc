<x-auth-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-800 mb-2">Rejoignez-nous</h2>
        <p class="text-slate-500 italic">Commencez l'aventure EasyColoc dès aujourd'hui.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-5">
            <x-input-label for="name" :value="__('Nom complet')" class="text-slate-700 font-semibold mb-2" />
            <input id="name" 
                   class="auth-input block w-full px-4 py-3 rounded-xl bg-slate-50/50 border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none" 
                   type="text" 
                   name="name" 
                   placeholder="Votre nom"
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-5">
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-semibold mb-2" />
            <input id="email" 
                   class="auth-input block w-full px-4 py-3 rounded-xl bg-slate-50/50 border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none" 
                   type="email" 
                   name="email" 
                   placeholder="votre@email.com"
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <x-input-label for="password" :value="__('Mot de passe')" class="text-slate-700 font-semibold mb-2" />
            <input id="password" 
                   class="auth-input block w-full px-4 py-3 rounded-xl bg-slate-50/50 border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none"
                   type="password"
                   name="password"
                   placeholder="Au moins 8 caractères"
                   required 
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-8">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-slate-700 font-semibold mb-2" />
            <input id="password_confirmation" 
                   class="auth-input block w-full px-4 py-3 rounded-xl bg-slate-50/50 border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none"
                   type="password"
                   name="password_confirmation" 
                   placeholder="••••••••"
                   required 
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="auth-btn-primary w-full py-4 rounded-2xl text-lg mb-6">
            Créer mon compte
        </button>

        <p class="text-center text-slate-600">
            Déjà inscrit ? 
            <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">
                Se connecter
            </a>
        </p>
    </form>
</x-auth-layout>
