<x-guest-layout>
    <h1 id="logregTitle">Jelszó helyreállítás</h1>
    <div class="container" id="loginDiv">
        <div class="col-md-4 col-xl-4 col-sm4" id="keret">
            <x-application-logo class="w-50 mx-auto"/>
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                  :value="old('email', $request->email)" required autofocus autocomplete="username"
                                  placeholder="E-mail cím"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                  autocomplete="new-password" placeholder="Jelszó"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password"
                                  placeholder="Jelszó újra"
                    />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Jelszó helyreállítása') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
