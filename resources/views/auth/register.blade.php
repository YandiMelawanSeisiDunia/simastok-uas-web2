@extends('layouts.app')
@section('title', 'Daftar')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="w-full max-w-sm bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold text-center mb-1">📦 SIMASTOK</h1>
        <p class="text-center text-sm text-gray-500 mb-6">Buat akun staff baru</p>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded text-sm">
                @foreach ($errors->all() as $error) <div>{{ $error }}</div> @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" required class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full border rounded px-3 py-2">
            </div>
            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded font-medium">Daftar</button>
        </form>
        <p class="text-sm text-center mt-4 text-gray-500">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Masuk</a>
        </p>
    </div>
</div>
@endsection
