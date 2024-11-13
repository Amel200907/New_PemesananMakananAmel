<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    //
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Delivery status updated');
    }

    public function chat(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $message = new Message([
            'sender' => 'Delivery',
            'content' => $request->message,
            'order_id' => $order->id
        ]);
        $message->save();

        return back()->with('success', 'Message sent');
    }

    public function sendMessage($id, Request $request)
    {
        // Logic for sending message to user
    }
}
