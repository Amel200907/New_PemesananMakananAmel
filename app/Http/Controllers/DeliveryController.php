<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;


class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::all();
        return view('delivery.index', compact('deliveries'));
    }

    public function create()
    {
        return view('delivery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required',
        ]);

        Delivery::create($request->all());

        return redirect()->route('delivery.index')->with('success', 'Delivery created successfully.');
    }

    public function edit($id)
    {
        $delivery = Delivery::findOrFail($id);
        return view('delivery.edit', compact('delivery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $delivery = Delivery::findOrFail($id);
        $delivery->update($request->all());

        return redirect()->route('delivery.index')->with('success', 'Delivery updated successfully.');
    }

    public function destroy($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();

        return redirect()->route('delivery.index')->with('success', 'Delivery deleted successfully.');
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->delivery_status = $request->input('status');
        $order->save();

        return redirect()->route('delivery.orders')->with('success', 'Delivery status updated successfully.');
    }

    public function orders()
    {
        $orders = Order::with('menu', 'user')
            ->where('status', 'Dalam Pengiriman')
            ->get();
        return view('delivery.orders.index', compact('orders'));
    }
}
