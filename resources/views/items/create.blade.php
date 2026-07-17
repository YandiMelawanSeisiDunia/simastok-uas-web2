@extends('layouts.app')
@section('title', 'Tambah Barang')
@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Barang</h1>
<div class="bg-white rounded-lg shadow p-6 max-w-xl">
    <form method="POST" action="{{ route('items.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Kategori</label>
            <select name="category_id" required class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">SKU</label>
                <input type="text" name="sku" value="{{ old('sku') }}" required class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Nama Barang</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Satuan</label>
                <input type="text" name="unit" value="{{ old('unit', 'pcs') }}" required class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Harga</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" required class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Stok Awal</label>
                <input type="number" name="stock_qty" value="{{ old('stock_qty', 0) }}" required class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Stok Minimum (untuk peringatan)</label>
            <input type="number" name="min_stock" value="{{ old('min_stock', 5) }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>
        <div class="flex gap-2">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('items.index') }}" class="px-4 py-2 rounded border">Batal</a>
        </div>
    </form>
</div>
@endsection
