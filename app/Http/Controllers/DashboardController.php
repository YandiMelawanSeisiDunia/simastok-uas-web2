<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockTransaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalStock = Item::sum('stock_qty');
        $lowStockItems = Item::whereColumn('stock_qty', '<=', 'min_stock')->get();
        $recentTransactions = StockTransaction::with(['item', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact('totalItems', 'totalStock', 'lowStockItems', 'recentTransactions'));
    }
}
