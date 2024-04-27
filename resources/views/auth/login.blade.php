<h1 id="logregTitle">Bejelentkezés</h1>
<div class="container" id="loginDiv">
    <div class="col-md-4 col-xl-4 col-sm4" id="keret">
        <x-application-logo class="w-50 mx-auto" />
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <hr />

        <!-- Username -->
        <div>
            <x-text-input id="username" class="form-control w-50 mx-auto" type="username" name="username" :value="old('username')" placeholder="Felhasználónév" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" />
        </div>

        <br />

        <!-- Password -->
        <div>
            <x-text-input id="password"
                            type="password"
                            name="password"
                            placeholder="Jelszó"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember">
                <span>{{ __('Emlékezz rám') }}</span>
            </label>
        </div>

        <hr />

        <x-primary-button class="flex items-center justify-end mt-4">
            {{ __('Bejelentkezés') }}
        </x-primary-button>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Elfelejtetted a jelszavad? Kattints ide!') }}
                </a>
            @endif
        </div>
    </form>
    <a href="{{ route('register') }}" class="flex items-center justify-end mt-4">
        <x-primary-button>
            {{ __('Registráció') }}
        </x-primary-button>
    </a>
</x-guest-layout>
