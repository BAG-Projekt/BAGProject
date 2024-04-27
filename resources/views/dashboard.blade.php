<x-app-layout>
    <div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 1050;">
        <div class="toast-container position-fixed top-1 end-0 p-3">
            @if(session('verified'))
            <div class="toast text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('verified') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="container">
        <div class="container-fluid" id="customDiv">
            <h1> Üdvözöllek, {{ Auth::user()->name }} </h1>
            <p class="lead">Ezen a felületen kezelheted az ügyfelek rendeléseit probléma esetén. A cég logójára kattintva
                elérheted a menü navigációs sávot, és ezáltal az oldalakat is, ahol kezelheted a rendeléseket. A profil ikonra kattintva a
                3 darab gomb van, amik fontosak. Például itt tudod módosítani a jelszavadat, le tudod ellenőrizni a személyes adataidat,
                és ezeken kívül kijelentkezni is
                a rendszerből</p>
            <p class="lead">Jó munkát kívánunk, és sok sikert!</p>
            <footer>BAG HR csapat</footer>
        </div>
    </div>
</x-app-layout>
