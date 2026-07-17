@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="w-full max-w-sm bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold text-center mb-1">📦 SIMASTOK</h1>
        <p class="text-center text-sm text-gray-500 mb-6">Sistem Manajemen Stok Barang</p>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded text-sm">
                @foreach ($errors->all() as $error) <div>{{ $error }}</div> @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember"> Ingat saya
            </label>
            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded font-medium">Masuk</button>
        </form>
        <p class="text-sm text-center mt-4 text-gray-500">
            Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Daftar</a>
        </p>
        <p class="text-xs text-center mt-4 text-gray-400">Demo: admin@simastok.test / password</p>
    </div>
</div>
@endsection
