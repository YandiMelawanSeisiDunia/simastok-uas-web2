@extends('layouts.app')
@section('title', 'Catat Transaksi Stok')
@section('content')
<h1 class="text-2xl font-bold mb-6">Catat Transaksi Stok</h1>

@if ($errors->any())
    <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded text-sm max-w-lg">
        @foreach ($errors->all() as $error) <div>{{ $error }}</div> @endforeach
    </div>
@endif

<div class="bg-white rounded-lg shadow p-6 max-w-lg">
    <form method="POST" action="{{ route('transactions.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Barang</label>
            <select name="item_id" required class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Barang --</option>
                @foreach($items as $it)
                    <option value="{{ $it->id }}" @selected(old('item_id') == $it->id)>{{ $it->name }} (stok: {{ $it->stock_qty }} {{ $it->unit }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Tipe Transaksi</label>
            <select name="type" required class="w-full border rounded px-3 py-2">
                <option value="in" @selected(old('type') === 'in')>Stok Masuk</option>
                <option value="out" @selected(old('type') === 'out')>Stok Keluar</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Jumlah</label>
            <input type="number" name="quantity" min="1" value="{{ old('quantity') }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Catatan (opsional)</label>
            <input type="text" name="note" value="{{ old('note') }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="flex gap-2">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Simpan Transaksi</button>
            <a href="{{ route('transactions.index') }}" class="px-4 py-2 rounded border">Batal</a>
        </div>
    </form>
</div>
@endsection
