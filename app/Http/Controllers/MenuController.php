<?php

namespace App\Http\Controllers;

use App\Models\Rating;
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

    public function create()
    {
        return view('admin.menu.create');
    }

    // Store a new menu
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menyimpan gambar menu
        $imagePath = $request->file('image')->store('menu_images', 'public');

        Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu created successfully!');
    } 
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }


    // Update a menu
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;

        // Jika ada gambar yang diupload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
            $menu->image = $imagePath;
        }

        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu updated successfully!');
    }
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu deleted successfully!');
    }
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.show', compact('menu'));
    }
    public function storeRating(Request $request, $menuId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        Rating::create([
            'menu_id' => $menuId,
            'user_id' => auth()->id(),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('menu.show', $menuId)->with('success', 'Rating berhasil ditambahkan.');
    }
}
