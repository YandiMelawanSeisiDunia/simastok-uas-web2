<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIMASTOK') - Sistem Manajemen Stok Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    @auth
    <div class="min-h-screen flex flex-col">
        <nav class="bg-indigo-700 text-white shadow">
            <div class="max-w-6xl mx-auto px-4">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-6">
                        <a href="{{ route('dashboard') }}" class="font-bold text-lg">📦 SIMASTOK</a>
                        <a href="{{ route('dashboard') }}" class="text-sm hover:text-indigo-200">Dashboard</a>
                        <a href="{{ route('items.index') }}" class="text-sm hover:text-indigo-200">Barang</a>
                        <a href="{{ route('transactions.index') }}" class="text-sm hover:text-indigo-200">Transaksi Stok</a>
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('categories.index') }}" class="text-sm hover:text-indigo-200">Kategori</a>
                        @endif
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm">{{ auth()->user()->name }} <span class="text-indigo-200">({{ auth()->user()->role }})</span></span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="text-sm bg-indigo-900 hover:bg-indigo-800 px-3 py-1 rounded">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <main class="flex-1 max-w-6xl mx-auto w-full px-4 py-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
    @else
        @yield('content')
    @endauth
</body>
</html>
