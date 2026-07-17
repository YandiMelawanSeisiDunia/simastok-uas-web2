@extends('layouts.app')
@section('title', 'Edit Kategori')
@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Kategori</h1>
<div class="bg-white rounded-lg shadow p-6 max-w-lg">
    <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium mb-1">Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <input type="text" name="description" value="{{ old('description', $category->description) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="flex gap-2">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('categories.index') }}" class="px-4 py-2 rounded border">Batal</a>
        </div>
    </form>
</div>
@endsection
