<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Layanan;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'owner1',
                'email' => 'owner1@gmail.com',
                'password' => Hash::make('password'), // Password otomatis di-enkripsi
                'role' => 'Owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'capster1',
                'email' => 'capster1@gmail.com',
                'password' => Hash::make('capster1'),
                'role' => 'Capster',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Layanan::create([
            'id_layanan' => Layanan::generateId(),
            'nama_layanan' => 'Haircut Standard',
            'harga' => 35000,
        ]);

        Layanan::create([
            'id_layanan' => Layanan::generateId(),
            'nama_layanan' => 'Premium Haircut & Wash',
            'harga' => 50000,
        ]);

        Layanan::create([
            'id_layanan' => Layanan::generateId(),
            'nama_layanan' => 'Hair Dye / Pewarnaan',
            'harga' => 85000,
        ]);

        Layanan::create([
            'id_layanan' => Layanan::generateId(),
            'nama_layanan' => 'Shaving / Cukur Jenggot',
            'harga' => 20000,
        ]);
    }
}
