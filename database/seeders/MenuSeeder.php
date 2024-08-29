<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = ['Nasi Goreng', 'Ayam Bakar', 'Sate Ayam', 'Es Teh', 'Es Jeruk', 'Mie Goreng', 'Soto Ayam'];

        for ($i = 1; $i <= 10; $i++) {
            $randomMinutes = rand(0, 10);
            $randomTime = now()->subMinutes($randomMinutes);

            $randomWords = implode(' ', array_rand(array_flip($words), rand(2, 3)));

            DB::table('menus')->insert([
                'nama_menu' => $randomWords,
                'harga' => rand(5000, 50000),
                'gambar' => 'menu_image_' . $i . '.jpg',
                'waktu_pembuatan' => $randomTime,
                'kategori' => $i % 2 == 0 ? 'minuman' : 'makanan',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
