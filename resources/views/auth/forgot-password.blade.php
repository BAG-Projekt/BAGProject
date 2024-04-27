<x-guest-layout>
    <h1 id="logregTitle">Jelszó helyreállítása</h1>
    <div class="container" id="loginDiv">
        <div class="col-md-4 col-xl-4 col-sm4" id="keret">
            <x-application-logo class="w-50 mx-auto"/>
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Elfelejtetted a jelszavad?. Semmi gond. Csak tudasd velünk a regisztrációs e-mail címed, és
                küldünk egy új jelszót számodra.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')"/>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-text-input id="email" type="email" name="email" :value="old('email')" placeholder="E-mail cím"
                                  required autofocus />
                    <x-input-error :messages="$errors->get('email')" />
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
