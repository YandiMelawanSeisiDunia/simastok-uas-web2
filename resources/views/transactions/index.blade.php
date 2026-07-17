@extends('layouts.app')
@section('title', 'Transaksi Stok')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Transaksi Stok</h1>
    <a href="{{ route('transactions.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm font-medium">+ Catat Transaksi</a>
</div>

<form method="GET" class="flex gap-2 mb-4">
    <select name="type" class="border rounded px-3 py-2 text-sm">
        <option value="">Semua Tipe</option>
        <option value="in" @selected(request('type') === 'in')>Masuk</option>
        <option value="out" @selected(request('type') === 'out')>Keluar</option>
    </select>
    <select name="item_id" class="border rounded px-3 py-2 text-sm">
        <option value="">Semua Barang</option>
        @foreach($items as $it)
            <option value="{{ $it->id }}" @selected(request('item_id') == $it->id)>{{ $it->name }}</option>
        @endforeach
    </select>
    <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded text-sm">Filter</button>
</form>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-left">
            <tr><th class="p-3">Tanggal</th><th class="p-3">Barang</th><th class="p-3">Tipe</th><th class="p-3">Jumlah</th><th class="p-3">Oleh</th><th class="p-3">Catatan</th></tr>
        </thead>
        <tbody>
            @forelse($transactions as $trx)
            <tr class="border-t">
                <td class="p-3">{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                <td class="p-3 font-medium">{{ $trx->item->name }}</td>
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
            <tr><td colspan="6" class="p-4 text-center text-gray-400">Belum ada transaksi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $transactions->links() }}</div>
@endsection
