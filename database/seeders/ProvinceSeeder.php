<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            ['name' => 'Aceh'],
            ['name' => 'Bali'],
            ['name' => 'Banten'],
            ['name' => 'Jakarta'],
            ['name' => 'West Java'],
            ['name' => 'Central Java'],
            ['name' => 'East Java'],
            // Add more provinces as needed
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}
