<x-guest-layout>
    <h1 id="logregTitle">E-mail cím visszaigazolása</h1>
    <div class="container" id="loginDiv">
        <div class="col-md-4 col-xl-4 col-sm4" id="keret">
            <x-application-logo class="w-50 mx-auto"/>
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Köszönjük a regisztrációt! Mielőtt belekezdenénk, kérlek erősítsd meg az E-mail címedet azzal,
                hogy rákattintasz a linkre, amit elküldtünk neked. Amennyiben nem kaptál E-mailt küldünk újat. Kérlek
                nézd meg a Spam mappát is.') }}
            </div>

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-primary-button>
                            {{ __('Megerősítő E-mail újraküldése') }}
                        </x-primary-button>
                    </div>
                </form>
                <br />
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="btn btn-danger">
                        {{ __('Kijelentkezés') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
