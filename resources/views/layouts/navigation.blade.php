@php
$routes = [
'dashboard' => 'Főoldal',
'orders' => 'Rendelések',
'users' => 'Felhasználók',
'add' => 'Hozzáadás',
'users.search' => 'Felhasználók',
];
@endphp

<nav class="navbar navbar-expand-sm navMarg">
    <div class="container-fluid">
        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#leftMenu">
            <img width="100px" height="100px" src="logo.png" alt="Logó" title="Logó">
        </a>
        <ul class="navbar-nav me-auto navCurrentPage">
            <li class="nav-item">
                <a class="nav-link active" href="#">{{ $routes[Route::currentRouteName()] }}</a>
            </li>
        </ul>
        <div class="menu-container">
            <a data-bs-toggle="offcanvas" data-bs-target="#userInf" class="navbar-brand" href="#">
                <x-profile-logo alt="Profil"/>
            </a>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="leftMenu" aria-labelledby="leftMenuHeader">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="leftMenuHeader">Válassz almenüt</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Bezárás"
                title="Bezárás"></button>
    </div>
    <div class="offcanvas-body" id="leftMenuBody">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName()=='dashboard' ? 'active' : '' }}"
                   href="{{ Route::currentRouteName()=='dashboard' ? '#' : route('dashboard') }}">Főoldal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName()=='orders' ? 'active' : '' }}"
                   href="{{ Route::currentRouteName()=='orders' ? '#' : route('orders') }}">Rendelések</a>
            </li>
            @if (Auth::user()->rank === 'Manager' || Auth::user()->rank === 'Raktárvezető')
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName()=='users' ? 'active' : '' }}"
                   href="{{ Route::currentRouteName()=='users' ? '#' : route('users') }}">Felhasználók</a>
            </li>
            <li class="nav-item">
                <!--Itt lehet módosítani az áruszolgáltatókat, és az ügyfeleket-->
                <a class="nav-link {{ Route::currentRouteName()=='add' ? 'active' : '' }}"
                   href="{{ Route::currentRouteName()=='add' ? '#' : route('add') }}">Hozzáadás</a>
            </li>
            @endif
        </ul>
    </div>
</div>

<div class="offcanvas offcanvas-end" id="userInf">
    <div id="userInfHead" class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Bezárás"
                title="Bezárás"></button>
        <x-profile-logo id="monoPng" alt="Profil" width="50px" height="50px"/>
        <h5> {{ Auth::user()->name }} </h5>
        <hr>
    </div>
    <div class="offcanvas-body" id="userInfBody">
        <ul id="userTab">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#personalInfo">Személyes
                    adatok</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#passwordChange">Jelszó
                    módosítás</a></li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <li>
                    <a href="route('logout')"
                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Kijelentkezés') }}
                    </a>
                </li>
            </form>
        </ul>
    </div>
</div>
<div class="modal fade" id="personalInfo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Személyes adatok</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h5>Elérhetőségek:</h5>
                <p>Felhasználónév: <b>{{ Auth::user()->username }}</b></p>
                <p>Teljes név: <b>{{ Auth::user()->name }}</b></p>
                <p>Telefonszám: <b>{{ Auth::user()->pnumber }}</b></p>
                <p>E-mail cím: <b>{{ Auth::user()->email }}</b></p>
                <p>Hatáskör: <b class="@if(Auth::user()->rank == 'Manager') adminColor
              @elseif(Auth::user()->rank == 'Raktárvezető') storageManagerColor
              @else userColor
              @endif">{{ Auth::user()->rank }}</b></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Bezárás</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="passwordChange">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Jelszó módosítás</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label for="old_password" class="form-label">Régi jelszó:</label>
                    <input type="password" class="form-control" id="old_password" name="old_password">
                    <label for="new_password" class="form-label">Új jelszó:</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                    <label for="new_password_confirmation" class="form-label">Új jelszó újra:</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                    <br>
                    <button type="submit" class="btn btn-primary">Küldés</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Bezárás</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 1050;">
    <div class="toast-container position-fixed top-1 end-0 p-3">
        @if (session('success'))
        <div class="toast text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        @endif

        @if ($errors->any())
        <div class="toast text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">
            <div class="d-flex">
                @foreach ($errors->all() as $error)
                <div class="toast-body">
                    {{ $error }}
                </div>
                @endforeach
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        @endif

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl).show();
        });
    });
</script>
