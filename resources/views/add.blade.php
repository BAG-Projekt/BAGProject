<x-app-layout>
    <div class="container">
        <div class="row mx-auto">
            <div class="col-md-6 mx-auto">
                <button type="btn" id="userAddBtn" class="btn d-block w-50 mx-auto" data-bs-toggle="modal" data-bs-target="#userAddModal"> Felhasználó hozzáadása </button>
                <div class="table-responsive">
                    <table class="table table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Felhasználó neve</th>
                            <th>Jogosultság</th>
                            <th>Elérhetőség</th>
                        </tr>
                        </thead>

                        <!-- Table body -->
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->rank }}</td>
                            <td>
                                tel.: {{ $user->pnumber }}<br>
                                email: {{ $user->email}}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 mx-auto">
                <button type="btn" id="orderAddBtn" class="btn d-block w-50 mx-auto" data-bs-toggle="modal" data-bs-target="#productAddModal"> Rendelés hozzáadása </button>
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Áru neve</th>
                        <th>Áruszolgáltató</th>
                        <th>Rendelt (db)</th>
                        <th>Ár</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ $order->customer }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->base_price * $order->quantity }} Ft</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Felhasználó hozzáadási Modal -->
    <div class="modal fade" id="userAddModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3> Felhasználó hozzáadása </h3>
                </div>
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="modal-body">
                        <label for="userName" class="form-label">Felhasználónév:</label>
                        <input type="text" class="form-control" id="userName" placeholder="kispista123" name="username"><br>
                        <label for="userFullName" class="form-label">Felhasználó teljes neve:</label>
                        <input type="text" class="form-control" id="userFullName" placeholder="Kis Pista" name="name"><br>
                        <label for="userContactInfoPhoneNumber" class="form-label">Felhasználó telefonszáma:</label>
                        <input type="text" class="form-control" id="userContactInfoPhoneNumber" placeholder="+36301234567" name="pnumber"><br>
                        <label for="userContactInfoEmail" class="form-label">Felhasználó e-mail címe:</label>
                        <input type="email" class="form-control" id="userContactInfoEmail" placeholder="kispista123@gmail.com" name="email"><br>
                    </div>
                    <div class="modal-footer">
                        <button id="submitUser" class="btn float-start" type="submit"> Felhasználó hozzáadása </button>
                        <button class="btn closeBtn" type="btn" data-bs-dismiss="modal"> X </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Rendelés hozzáadási Modal -->
    <div class="modal fade" id="productAddModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Rendelés hozzáadása</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf
                    <div class="modal-body">
                        <label for="productName" class="form-label">Áru neve:</label>
                        <input type="text" class="form-control" id="productName" name="product_name">
                        <label for="productProvider" class="form-label">Áruszolgáltató:</label>
                        <input type="text" class="form-control" id="productProvider" name="customer">
                        <label for="orderAmount" class="form-label">Rendelt (db):</label>
                        <input type="number" class="form-control" id="orderAmount" name="quantity">
                        <label for="orderPrice" class="form-label">Ár:</label>
                        <input type="number" class="form-control" id="orderPrice" name="base_price">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Rendelés leadása</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Bezárás</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
