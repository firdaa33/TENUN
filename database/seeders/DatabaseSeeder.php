<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* 1.  Admin / Dummy User  */
       // database/seeders/DatabaseSeeder.php

        User::create([
            'name' => 'Admin SELAWEAVE',
            'email' => 'admin@selaweave.com',
            'phone' => '081234567890',
            'province' => 'Nusa Tenggara Barat',
            'city' => 'Kota Mataram',
            'district' => 'Cakranegara',
            'village' => 'Karang Pule',
            'address' => 'Jl. Selamet No.99',
            'password' => bcrypt('password'), // ← bisa kamu ubah
        ]);

        /* 2.  Produk Dummy  */
        $this->call(ProductSeeder::class);

        /* 3.  (Opsional) Seeder lain
         * $this->call([
         *     OrderSeeder::class,
         *     ChatSeeder::class,
         * ]);
         */
    }
}
