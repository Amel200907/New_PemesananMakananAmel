<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $favoriteItems = Menu::take(5)->get();  
        $trendingMenus = Menu::take(5)->get(); 

        return view('dashboard', compact('favoriteItems', 'trendingMenus'));
    }
}
