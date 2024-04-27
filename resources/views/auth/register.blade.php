<x-guest-layout>
    <h1 id="logregTitle">Regisztráció</h1>
    <div class="container" id="loginDiv">
        <div class="col-md-4 col-xl-4 col-sm4" id="keret">
            <x-application-logo />
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Full Name -->
                <div>
                    <x-text-input id="name" type="text" name="name" :value="old('name')"
                                  required autofocus autocomplete="name" placeholder="Teljes név"/>
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <br />

                <!-- User Name -->
                <div>
                    <x-text-input id="username" type="text" name="username" :value="old('username')"
                                  required autofocus autocomplete="username" placeholder="Felhasználónév"/>
                    <x-input-error :messages="$errors->get('username')" />
                </div>

                <br />

                <!-- Email Address -->
                <div>
                    <x-text-input id="email" type="email" name="email" :value="old('email')"
                                  required autocomplete="email" placeholder="E-mail cím"/>
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <br />

                <!-- Phone number -->
                <div>
                    <x-text-input id="pnumber" type="text" name="pnumber" :value="old('pnumber')"
                                  required autofocus autocomplete="pnumber" placeholder="Telefonszám"/>
                    <x-input-error :messages="$errors->get('pnumber')" />
                </div>

                <br />

                <!-- Password -->
                <div>
                    <x-text-input id="password"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password"
                                  placeholder="Jelszó"
                    />

                    <x-input-error :messages="$errors->get('password')" />
                </div>

                <br />

                <!-- Confirm Password -->
                <div>
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password"
                                  placeholder="Jelszó újra"
                    />

                    <x-input-error :messages="$errors->get('password_confirmation')" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('login') }}">
                        {{ __('Már regisztrálva vagy? Lépj be') }}
                    </a>

                    <x-primary-button class="flex items-center justify-end mt-4">
                        {{ __('Regisztráció') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
