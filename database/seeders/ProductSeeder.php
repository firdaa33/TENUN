<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder {
    public function run(): void {
        $produk = [
            ['Tenun Sumba Merah', 'Kain tenun khas Sumba dengan motif tradisional'],
            ['Tenun Troso Biru', 'Motif geometris khas Jepara dengan warna biru laut'],
            ['Tenun Lombok Emas', 'Kain dengan warna emas yang elegan dan eksklusif'],
            ['Tenun Ikat Bali', 'Tenun ikat dengan corak khas Pulau Dewata'],
        ];

        foreach ($produk as [$name, $desc]) {
            Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $desc,
                'price' => rand(150000, 450000),
                'stock' => rand(3, 10),
                'image' => 'produk.jpg', // Ganti sesuai gambar dummy kamu
            ]);
        }
    }
}
