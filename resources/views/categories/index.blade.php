@extends('layouts.app')
@section('title', 'Kategori')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Kategori Barang</h1>
    <a href="{{ route('categories.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm font-medium">+ Tambah Kategori</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="p-3">Nama</th>
                <th class="p-3">Deskripsi</th>
                <th class="p-3">Jumlah Barang</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr class="border-t">
                <td class="p-3 font-medium">{{ $category->name }}</td>
                <td class="p-3 text-gray-500">{{ $category->description ?? '-' }}</td>
                <td class="p-3">{{ $category->items_count }}</td>
                <td class="p-3 space-x-2">
                    <a href="{{ route('categories.edit', $category) }}" class="text-indigo-600 hover:underline">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-4 text-center text-gray-400">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $categories->links() }}</div>
@endsection
