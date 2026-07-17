<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin SIMASTOK',
            'email' => 'admin@simastok.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@simastok.test',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        $alat = Category::create(['name' => 'Alat Tulis Kantor', 'description' => 'Perlengkapan tulis dan kantor']);
        $elektronik = Category::create(['name' => 'Elektronik', 'description' => 'Perangkat elektronik ringan']);
        $minuman = Category::create(['name' => 'Minuman', 'description' => 'Stok minuman kemasan']);

        Item::create([
            'category_id' => $alat->id,
            'sku' => 'ATK-001',
            'name' => 'Pulpen Standard AE7',
            'unit' => 'pcs',
            'price' => 3500,
            'stock_qty' => 120,
            'min_stock' => 20,
            'description' => 'Pulpen tinta hitam standar kantor.',
        ]);

        Item::create([
            'category_id' => $alat->id,
            'sku' => 'ATK-002',
            'name' => 'Buku Tulis 58 Lembar',
            'unit' => 'pcs',
            'price' => 5000,
            'stock_qty' => 8,
            'min_stock' => 15,
            'description' => 'Buku tulis isi 58 lembar.',
        ]);

        Item::create([
            'category_id' => $elektronik->id,
            'sku' => 'ELK-001',
            'name' => 'Flashdisk 32GB',
            'unit' => 'pcs',
            'price' => 65000,
            'stock_qty' => 25,
            'min_stock' => 5,
            'description' => 'Flashdisk USB 3.0 32GB.',
        ]);

        Item::create([
            'category_id' => $minuman->id,
            'sku' => 'MNM-001',
            'name' => 'Air Mineral 600ml',
            'unit' => 'botol',
            'price' => 3000,
            'stock_qty' => 200,
            'min_stock' => 50,
            'description' => 'Air mineral kemasan botol 600ml.',
        ]);
    }
}
