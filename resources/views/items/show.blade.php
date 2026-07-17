@extends('layouts.app')
@section('title', $item->name)
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">{{ $item->name }}</h1>
    <a href="{{ route('items.index') }}" class="text-sm text-indigo-600 hover:underline">&larr; Kembali</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-5">
        <p class="text-sm text-gray-500">SKU</p>
        <p class="text-lg font-semibold">{{ $item->sku }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5">
        <p class="text-sm text-gray-500">Kategori</p>
        <p class="text-lg font-semibold">{{ $item->category->name }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5">
        <p class="text-sm text-gray-500">Stok Saat Ini</p>
        <p class="text-lg font-semibold {{ $item->isLowStock() ? 'text-red-600' : '' }}">{{ $item->stock_qty }} {{ $item->unit }}</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-5 mb-6">
    <p class="text-sm text-gray-500 mb-1">Deskripsi</p>
    <p>{{ $item->description ?? '-' }}</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b font-semibold">Riwayat Transaksi Stok</div>
    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-left">
            <tr><th class="p-3">Tanggal</th><th class="p-3">Tipe</th><th class="p-3">Jumlah</th><th class="p-3">Oleh</th><th class="p-3">Catatan</th></tr>
        </thead>
        <tbody>
            @forelse($item->stockTransactions->sortByDesc('created_at') as $trx)
            <tr class="border-t">
                <td class="p-3">{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                <td class="p-3">
                    <span class="{{ $trx->type === 'in' ? 'text-green-600' : 'text-red-600' }} font-semibold">
                        {{ $trx->type === 'in' ? 'Masuk' : 'Keluar' }}
                    </span>
                </td>
                <td class="p-3">{{ $trx->quantity }}</td>
                <td class="p-3">{{ $trx->user->name }}</td>
                <td class="p-3 text-gray-500">{{ $trx->note ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="p-4 text-center text-gray-400">Belum ada transaksi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
