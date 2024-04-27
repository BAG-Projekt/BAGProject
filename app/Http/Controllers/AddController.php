<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

class AddController extends Controller
{
    public function index()
    {
        $users = User::all();
        $orders = Order::all();

        return view('add', ['users' => $users, 'orders' => $orders]);
    }
}
