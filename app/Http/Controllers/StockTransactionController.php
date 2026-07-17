<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockTransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = StockTransaction::with(['item', 'user'])
            ->when($request->type, fn ($q) => $q->where('type', $request->type))
            ->when($request->item_id, fn ($q) => $q->where('item_id', $request->item_id))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $items = Item::orderBy('name')->get();

        return view('transactions.index', compact('transactions', 'items'));
    }

    public function create()
    {
        $items = Item::orderBy('name')->get();

        return view('transactions.create', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_id' => ['required', 'exists:items,id'],
            'type' => ['required', 'in:in,out'],
            'quantity' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($data, $request) {
            $item = Item::lockForUpdate()->findOrFail($data['item_id']);

            if ($data['type'] === 'out' && $item->stock_qty < $data['quantity']) {
                abort(422, 'Stok tidak mencukupi untuk transaksi keluar ini.');
            }

            StockTransaction::create([
                'item_id' => $item->id,
                'user_id' => $request->user()->id,
                'type' => $data['type'],
                'quantity' => $data['quantity'],
                'note' => $data['note'] ?? null,
            ]);

            $item->stock_qty = $data['type'] === 'in'
                ? $item->stock_qty + $data['quantity']
                : $item->stock_qty - $data['quantity'];
            $item->save();
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi stok berhasil dicatat.');
    }
}
