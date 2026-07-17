@extends('layouts.app')
@section('title', 'Barang')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Data Barang</h1>
    @if(auth()->user()->isAdmin())
    <a href="{{ route('items.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm font-medium">+ Tambah Barang</a>
    @endif
</div>

<form method="GET" class="flex gap-2 mb-4">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / SKU..." class="border rounded px-3 py-2 text-sm flex-1">
    <select name="category_id" class="border rounded px-3 py-2 text-sm">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
    </select>
    <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded text-sm">Filter</button>
</form>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="p-3">SKU</th>
                <th class="p-3">Nama Barang</th>
                <th class="p-3">Kategori</th>
                <th class="p-3">Harga</th>
                <th class="p-3">Stok</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
            <tr class="border-t {{ $item->isLowStock() ? 'bg-red-50' : '' }}">
                <td class="p-3">{{ $item->sku }}</td>
                <td class="p-3 font-medium">{{ $item->name }}</td>
                <td class="p-3">{{ $item->category->name }}</td>
                <td class="p-3">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="p-3">
                    <span class="{{ $item->isLowStock() ? 'text-red-600 font-semibold' : '' }}">{{ $item->stock_qty }} {{ $item->unit }}</span>
                </td>
                <td class="p-3 space-x-2">
                    <a href="{{ route('items.show', $item) }}" class="text-indigo-600 hover:underline">Detail</a>
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('items.edit', $item) }}" class="text-indigo-600 hover:underline">Edit</a>
                    <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus barang ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="p-4 text-center text-gray-400">Belum ada data barang.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $items->links() }}</div>
@endsection
