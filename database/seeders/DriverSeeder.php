<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budisantoso@gmail.com',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 123, Jakarta',
            ],
            [
                'name' => 'Agus Rahman',
                'email' => 'agusrahman@gmail.com',
                'phone' => '081234567891',
                'address' => 'Jl. Kebon Jeruk No. 45, Bandung',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewilestari@gmail.com',
                'phone' => '081234567892',
                'address' => 'Jl. Sudirman No. 67, Surabaya',
            ],
            [
                'name' => 'Rudi Hartono',
                'email' => 'rudihartono@gmail.com',
                'phone' => '081234567893',
                'address' => 'Jl. Ahmad Yani No. 89, Yogyakarta',
            ],
            [
                'name' => 'Mira Sari',
                'email' => 'mirasari@gmail.com',
                'phone' => '081234567894',
                'address' => 'Jl. Diponegoro No. 101, Medan',
            ],
            [
                'name' => 'Eka Putra',
                'email' => 'ekaputra@gmail.com',
                'phone' => '081234567895',
                'address' => 'Jl. Pahlawan No. 202, Semarang',
            ],
            [
                'name' => 'Tari Wulan',
                'email' => 'tariwulan@gmail.com',
                'phone' => '081234567896',
                'address' => 'Jl. Kartini No. 303, Makassar',
            ],
            [
                'name' => 'Ali Syah',
                'email' => 'alisyah@gmail.com',
                'phone' => '081234567897',
                'address' => 'Jl. Dipati Ukur No. 404, Denpasar',
            ],
            [
                'name' => 'Sari Dewi',
                'email' => 'saridewi@gmail.com',
                'phone' => '081234567898',
                'address' => 'Jl. Teuku Umar No. 505, Malang',
            ],
            [
                'name' => 'Iwan Pratama',
                'email' => 'iwanpratama@gmail.com',
                'phone' => '081234567899',
                'address' => 'Jl. Panglima Polim No. 606, Padang',
            ],
        ];


        foreach ($drivers as $driver) {
            Driver::create($driver);
        }
    }
}
