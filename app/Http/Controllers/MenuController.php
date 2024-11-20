<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    //
    public function index()
    {
        $menus = Menu::all();
        return view('menu.index', compact('menus'));
    }

    // Show form to create a new menu
    public function create()
    {
        return view('admin.menu.create'); // Pastikan ada file blade ini
    }

    // Store a new menu
    public function store(Request $request)
    {
        // Cek apakah pengguna adalah admin
        if (auth()->check() && auth()->user()->role == 'admin') {
            // Proses menyimpan menu baru
            $validated = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
                'category' => 'required',
                'image' => 'nullable|image|max:1024',
            ]);

            // Simpan menu
            $menu = new Menu();
            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->description = $request->description;
            $menu->save();

            return redirect()->route('admin.dashboard')->with('success', 'Menu has been added.');

            
        }

        // Jika bukan admin, redirect ke halaman utama dengan pesan error
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
    // Show form to edit a menu
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    // Update a menu
    public function update($id, Request $request)
    {
        $menu = Menu::findOrFail($id);
        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->description = $request->description;
        $menu->save();

        return redirect()->route('admin.dashboard')->with('success', 'Menu has been updated.');

        $menu = Menu::findOrFail($id);

        $imagePath = $menu->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($imagePath) {
                Storage::delete('public/' . $imagePath);
            }

            // Upload new image
            $imagePath = $request->file('image')->store('menu', 'public');
        }

        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('menu.index');
    }

    // Delete a menu
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Menu has been deleted.');
    }
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.show', compact('menu'));
    }
}
