@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-white p-5 rounded-lg shadow border-l-4 border-indigo-500">
        <p class="text-sm text-gray-500">Total Jenis Barang</p>
        <p class="text-3xl font-bold">{{ $totalItems }}</p>
    </div>
    <div class="bg-white p-5 rounded-lg shadow border-l-4 border-green-500">
        <p class="text-sm text-gray-500">Total Unit Stok</p>
        <p class="text-3xl font-bold">{{ $totalStock }}</p>
    </div>
    <div class="bg-white p-5 rounded-lg shadow border-l-4 border-red-500">
        <p class="text-sm text-gray-500">Barang Stok Menipis</p>
        <p class="text-3xl font-bold">{{ $lowStockItems->count() }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-5">
        <h2 class="font-semibold mb-3">⚠️ Barang Stok Menipis</h2>
        @forelse($lowStockItems as $item)
            <div class="flex justify-between items-center py-2 border-b last:border-0">
                <div>
                    <p class="font-medium">{{ $item->name }}</p>
                    <p class="text-xs text-gray-500">{{ $item->sku }}</p>
                </div>
                <span class="text-red-600 font-semibold">{{ $item->stock_qty }} {{ $item->unit }}</span>
            </div>
        @empty
            <p class="text-sm text-gray-400">Semua stok aman.</p>
        @endforelse
    </div>

    <div class="bg-white rounded-lg shadow p-5">
        <h2 class="font-semibold mb-3">🕒 Transaksi Terbaru</h2>
        @forelse($recentTransactions as $trx)
            <div class="flex justify-between items-center py-2 border-b last:border-0 text-sm">
                <div>
                    <p class="font-medium">{{ $trx->item->name }}</p>
                    <p class="text-xs text-gray-500">oleh {{ $trx->user->name }} &middot; {{ $trx->created_at->diffForHumans() }}</p>
                </div>
                <span class="{{ $trx->type === 'in' ? 'text-green-600' : 'text-red-600' }} font-semibold">
                    {{ $trx->type === 'in' ? '+' : '-' }}{{ $trx->quantity }}
                </span>
            </div>
        @empty
            <p class="text-sm text-gray-400">Belum ada transaksi.</p>
        @endforelse
    </div>
</div>
@endsection
