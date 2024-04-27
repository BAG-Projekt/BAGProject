<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('orders', ['orders' => $orders]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'customer' => 'required',
            'quantity' => 'required|integer',
            'base_price' => 'required|numeric',
        ]);

        $order = new Order;
        $order->product_name = $request->product_name;
        $order->customer = $request->customer;
        $order->quantity = $request->quantity;
        $order->base_price = $request->base_price;
        $order->save();

        return redirect()->back()->with('success', 'Order added successfully');
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->delete();

            return back()->with('success', 'Rendelés sikeresen törölve');
        } else {
            return back()->withErrors('error', 'Rendelés nem található')->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if (! $order) {
            return back()->withErrors('error', 'Rendelés nem található')->withInput();
        }

        $request->validate([
            'product_name' => 'required',
            'customer' => 'required',
            'quantity' => 'required|integer',
            'base_price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $order->update($request->all());

        return back()->with('success', 'Rendelés sikeresen módosítva');
    }
}
