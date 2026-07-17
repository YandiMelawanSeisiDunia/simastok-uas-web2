@extends('layouts.app')
@section('title', 'Tambah Kategori')
@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Kategori</h1>
<div class="bg-white rounded-lg shadow p-6 max-w-lg">
    <form method="POST" action="{{ route('categories.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full border rounded px-3 py-2">
            @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <input type="text" name="description" value="{{ old('description') }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="flex gap-2">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('categories.index') }}" class="px-4 py-2 rounded border">Batal</a>
        </div>
    </form>
</div>
@endsection
