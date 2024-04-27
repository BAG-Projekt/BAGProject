<x-guest-layout>
    <h1 id="logregTitle">Igazolás</h1>
    <div class="container" id="loginDiv">
        <div class="col-md-4 col-xl-4 col-sm4" id="keret">
            <x-application-logo class="w-50 mx-auto"/>
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Ez a biztonsági rész. Kérlek erősítsd meg a jelszavad a továbblépéshez.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div>
                    <x-text-input id="password"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" placeholder="Jelszó"/>

                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <div class="flex justify-end mt-4">
                    <x-primary-button>
                        {{ __('Megerősítés') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
