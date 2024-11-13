<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function create(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'menu_id' => $request->menu_id,
            'quantity' => $request->quantity,
            'status' => 'pending',
        ]);

        return redirect()->route('order.show', $order->id)->with('success', 'Order created successfully');
    }

    public function show($id)
    {
        $order = Order::with('menu')->findOrFail($id);
        return view('order.show', compact('order'));
    }


    // View Order Status
    public function status($id)
    {
        $order = Order::findOrFail($id);
        return view('order.status', compact('order'));
    }
    public function history()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('order.history', compact('orders'));
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated');
    }
}
