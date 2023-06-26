<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'notelp' => '00934384343',
            'password' => Hash::make('password'),
            'role' => 1,
        ]);
        DB::table('users')->insert([
            'username' => 'seller',
            'email' => 'seller@gmail.com',
            'notelp' => '04839438439',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 2,
        ]);
        DB::table('stores')->insert([
            'nama_toko' => 'seller',
            'user_id' => '2',
            'notelp_toko' => '08343974394',
            'alamat_toko' => 'jimbaran',
        ]);
        DB::table('users')->insert([
            'username' => 'customer',
            'email' => 'customer@gmail.com',
            'notelp' => '0438943843',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 3,
        ]);
    }
}
