<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\FavoriteItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        // Query untuk mendapatkan 5 item terfavorit berdasarkan penjualan
        $favoriteItems = FavoriteItem::with(['menu'])  // pastikan FavoriteItem punya relasi dengan Menu
            ->selectRaw('menu_id, COUNT(*) as total_sales')
            ->groupBy('menu_id')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get();
    
        // Debugging: Pastikan data yang dikirim ke view ada
        dd($favoriteItems);  // Akan menampilkan data di halaman
    
        $favoriteItems = $favoriteItems->map(function ($item) {
            return [
                'name' => $item->menu->name, // Nama menu dari relasi
                'image' => $item->menu->image, // Gambar menu dari relasi
                'rating' => $item->menu->ratings->avg('rating') ?? 0, // Rating rata-rata
                'reviews_count' => $item->menu->ratings->count(), // Jumlah ulasan
                'total_sales' => $item->total_sales, // Total penjualan
                'percentage' => $item->total_sales / FavoriteItem::count() * 100, // Persentase
            ];
        });
    
        return view('admin.dashboard', compact('favoriteItems'));
    }
    
}
