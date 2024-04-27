<x-app-layout>
    <div class="container">
        <div class="container-fluid" id="customDiv">
            <h3 id="filterH3"> Szűréses keresés </h3>
            <form class="d-flex searchBarMarg">
                <div class="dropdown">
                    <button type="button" id="dropDownMrg" class="btn btn-primary dropdown-toggle"
                            data-bs-toggle="dropdown">
                        Szűrési feltételek
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><input type="checkbox"> ID</a></li>
                        <li><a class="dropdown-item" href="#"><input type="checkbox"> Áru neve</a></li>
                        <li><a class="dropdown-item" href="#"><input type="checkbox"> Áruszolgáltató</a></li>
                        <li><a class="dropdown-item" href="#"><input type="checkbox"> Ügyfél</a></li>
                        <li><a class="dropdown-item" href="#"><input type="checkbox"> Raktáron (db)</a></li>
                        <li><a class="dropdown-item" href="#"><input type="checkbox"> Állapot</a></li>
                        <li><a class="dropdown-item" href="#"><input type="checkbox"> Dátum</a></li>
                    </ul>
                </div>
                <input class="form-control me-2 w-25" type="text" placeholder="Keresés...">
                <button class="btn" id="" type="submit">Keresés</button>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-responsive table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Áru neve</th>
                    <th>Áruszolgáltató</th>
                    <th>Rendelt (db)</th>
                    <th>Ára (1*x)</th>
                    <th>Rendelés dátuma</th>
                    <th>Rendelés állapota</th>
                    <th>Műveletek</th>
                </tr>
                </thead>

                <!-- Table body -->
                <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->product_name }}</td>
                    <td>{{ $order->customer }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->base_price * $order->quantity }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#cancelProduct-ID-{{ $order->id }}"><img
                                srcset="https://img.icons8.com/?size=100&amp;id=66767&amp;format=png 2x, https://img.icons8.com/?size=100&amp;id=66767&amp;format=png 1x"
                                src="https://img.icons8.com/?size=100&amp;id=66767&amp;format=png 2x"
                                alt="Rendelés törlése" title="Rendelés törlése" width="30px" height="30px"></a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#editProductInfo-ID-{{ $order->id }}"><img
                                alt="Rendelés módosítása" title="Rendelés módosítása"
                                srcset="https://img.icons8.com/?size=60&amp;id=100418&amp;format=png 2x, https://img.icons8.com/?size=60&amp;id=100418&amp;format=png 1x"
                                src="https://img.icons8.com/?size=60&amp;id=100418&amp;format=png 2x" width="30"
                                height="30"></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach($orders as $order)
    <div class="modal fade" id="cancelProduct-ID-{{ $order->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Rendelés visszavonása</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <h3>Biztos szeretnéd törölni az alábbi rendelést?</h3>
                        <p>ID: <b>{{ $order->id }}</b></p>
                        <p>Név: <b>{{ $order->product_name }}</b></p>
                        <p>Rendelt mennyiség: <b>{{ $order->quantity }}</b></p>
                        <button id="cancelBtn" type="submit" class="btn closeBtn marginBtn">Visszavonás</button>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Vissza</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editProductInfo-ID-{{ $order->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Rendelés módosítása</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="currentSelected">Jelenleg kiválasztott rendelés: <b>ID: {{ $order->id }} ({{
                            $order->product_name }})</b></p>
                    <div class="d-flex align-items-center">
                        <form action="{{ route('orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="status-{{ $order->id }}" class="me-2">Rendelés státusza:</label>
                            <select id="status-{{ $order->id }}" class="form-select" name="status">
                                <option value="{{ $order->status }}">Jelenlegi állapot: {{ $order->status }}</option>
                                <option value="Úton a raktárba">Úton a raktárba</option>
                                <option value="Úton az ügyfélhez">Úton az ügyfélhez</option>
                                <option value="Úton az üzletbe">Úton az üzletbe</option>
                                <option value="Kiszállítva">Kiszállítva</option>
                                <option value="Nincs kiszállítva">Nincs kiszállítva</option>
                            </select>
                            <br>
                            <label for="product_name" class="form-label">Áru neve:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name"
                                   value="{{ $order->product_name }}"><br>
                            <label for="quantity" class="form-label">Mennyiség:</label>
                            <input type="text" class="form-control" id="quantity" name="quantity"
                                   value="{{ $order->quantity }}"><br>
                            <label for="customer" class="form-label">Áruszolgáltató:</label>
                            <input type="text" class="form-control" id="customer" value="{{ $order->customer }}"
                                   name="customer"><br>
                            <label for="base_price" class="form-label">Ár:</label>
                            <input type="text" class="form-control" id="base_price"
                                   value="{{ $order->base_price * $order->quantity }}" name="price"><br>
                            <label for="orderDate" class="form-label">Rendelés dátuma:</label>
                            <input type="datetime-local" class="form-control" id="orderDate" value="{{ $order->created_at }}"
                                   name="orderDate"><br>
                            <button id="confirmEdit" type="submit" class="btn openBtn marginBtn">Mentés</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Vissza</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>
