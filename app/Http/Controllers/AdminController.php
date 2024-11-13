<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
    //
    public function index()
    {
        // Menampilkan dashboard admin
        $menus = Menu::all();
        $orders = Order::where('status', 'pending')->get();
        return view('admin.dashboard', compact('menus', 'orders'));
    }

    public function createMenu(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        // Menyimpan gambar ke storage dan mengambil path-nya
        $imagePath = $request->file('image')->store('menu_images', 'public');

        // Membuat menu baru
        Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'image' => $imagePath, // Menyimpan path gambar
        ]);

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan');
    }

    public function manageOrders()
    {
        $orders = Order::all();
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status; // Status baru dari request
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Order status updated.');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin');
        }

        return back()->with('error', 'Invalid credentials');
    }
}
