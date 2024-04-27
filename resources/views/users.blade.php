<x-app-layout>
    <div class="container">
        <div class="container-fluid" id="customDiv">
            <h3 id="filterH3"> Szűréses keresés </h3>
            <form id="searchForm" class="d-flex searchBarMarg" action="{{ route('users.search') }}" method="GET">
                <div class="dropdown">
                    <button type="button" id="dropDownMrg" class="btn btn-primary dropdown-toggle"
                            data-bs-toggle="dropdown">
                        Szűrési feltételek
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><input type="checkbox" name="filter[id]"> ID</a></li>
                        <li><a class="dropdown-item" href="#"><input type="checkbox" name="filter[name]"> Felhasználók</a></li>
                        <li><a class="dropdown-item" href="#"><input type="checkbox" name="filter[rank]"> Jogosultság</a></li>
                        <li><a class="dropdown-item" href="#"><input type="checkbox" name="filter[created_at]"> Kapcsolattartás kezdetének dátuma</a></li>
                        <li><a class="dropdown-item" href="#"><input type="checkbox" name="filter[contact]"> Elérhetőség</a></li>
                    </ul>
                </div>
                <input id="searchInput" class="form-control me-2 w-25" type="text" name="search" placeholder="Keresés...">
                <button id="searchButton" class="btn" type="submit">Keresés</button>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-responsive table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Felhasználók</th>
                    <th>Jogosulstág</th>
                    <th>Kapcsolattartás kezdetének dátuma</th>
                    <th>Elérhetőség</th>
                    <th>Műveletek</th>
                </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td class="userColor">{{ $user->rank }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            tel.: {{ $user->pnumber }}<br>
                            email: {{ $user->email}}
                        </td>
                        <td>
                            @if(Auth::user()->rank != $user->rank || $user->rank != 'Raktárvezető')
                            <a href="#" data-bs-toggle="modal" data-bs-target="#deleteUserModal-User-{{ $user->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                     viewBox="0 0 24 24">
                                    <path
                                        d="M 10 2 L 9 3 L 4 3 L 4 5 L 5 5 L 5 20 C 5 20.522222 5.1913289 21.05461 5.5683594 21.431641 C 5.9453899 21.808671 6.4777778 22 7 22 L 17 22 C 17.522222 22 18.05461 21.808671 18.431641 21.431641 C 18.808671 21.05461 19 20.522222 19 20 L 19 5 L 20 5 L 20 3 L 15 3 L 14 2 L 10 2 z M 7 5 L 17 5 L 17 20 L 7 20 L 7 5 z M 9 7 L 9 18 L 11 18 L 11 7 L 9 7 z M 13 7 L 13 18 L 15 18 L 15 7 L 13 7 z"></path>
                                </svg>
                            </a>
                            @endif
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editUserModal-User-{{ $user->id }}">
                                <img
                                    srcset="https://img.icons8.com/?size=60&amp;id=100418&amp;format=png 2x, https://img.icons8.com/?size=60&amp;id=100418&amp;format=png 1x"
                                    src="https://img.icons8.com/?size=60&amp;id=100418&amp;format=png 2x" width="30"
                                    height="30">
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach($users as $user)
        <div class="modal fade" id="editUserModal-User-{{ $user->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Felhasználó módosítása</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p id="currentSelected">Jelenleg kiválasztott felhasználó: <b>{{ $user->name }}
                                ({{ $user->username }})</b></p>
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="username" class="form-label">Felhasználónév:</label>
                            <input type="text" class="form-control" id="username" name="username"
                                   value="{{ $user->username }}"><br>
                            <label for="name" class="form-label">Teljes név:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $user->name }}"><br>
                            @if(Auth::user()->rank == 'Raktárvezető')
                                <div class="d-flex align-items-center">
                                    <label for="userPermChangeBtn" class="me-2">Jogosultság:</label>
                                    <select id="rank" class="form-select" name="rank">
                                        <option value="{{ $user->rank }}">Jelenlegi állapot: {{ $user->rank }}</option>
                                        <option value="Úton a raktárba">Dolgozó</option>
                                        <option value="Úton az ügyfélhez">Manager</option>
                                    </select>
                                </div>
                            @endif
                            <label for="pnumber" class="form-label">Telefonszám:</label>
                            <input type="text" class="form-control" id="pnumber"
                                   name="pnumber" value="{{ $user->pnumber }}"><br>
                            <label for="email" class="form-label">E-mail cím:</label>
                            <input type="email" class="form-control" id="email"
                                   name="email" value="{{ $user->email }}"><br>
                            <button id="confirmEdit" type="submit" class="btn openBtn">Mentés</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Vissza</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @foreach($users as $user)
        <div class="modal fade" id="deleteUserModal-User-{{ $user->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Felhasználó törlésének megerősítése</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h5>Biztos vagy benne, hogy törölni szeretnéd ezt a felhasználót?</h5>
                            <p>Felhasználónév: <b>{{ $user->username }}</b></p>
                            <p>Teljes név: <b>{{ $user->name }}</b></p>
                            <p>Jogosultság: <b class="@if($user->rank == 'Manager') adminColor
                                        @elseif($user->rank == 'Raktárvezető') storageManagerColor
                                        @else userColor
                                        @endif">{{ $user->rank }}</b></p>
                            <div class="container">
                                <div class="row">
                                    <div class="col-10">
                                        <button id="confirmDelYes" type="submit" class="btn openBtn">Igen</button>
                                    </div>
                                    <div class="col-2">
                                        <button id="confirmDelNo" type="button" class="btn closeBtn"
                                                data-bs-dismiss="modal">Nem
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
