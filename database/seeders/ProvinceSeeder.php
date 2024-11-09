<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

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
            ['name' => 'Yogyakarta'],
            ['name' => 'West Sumatra'],
            ['name' => 'North Sumatra'],
            ['name' => 'South Sumatra'],
            ['name' => 'Lampung'],
            ['name' => 'Riau'],
            ['name' => 'Riau Islands'],
            ['name' => 'East Kalimantan'],
            ['name' => 'South Kalimantan'],
            ['name' => 'Central Kalimantan'],
            ['name' => 'West Kalimantan'],
            ['name' => 'North Kalimantan'],
            ['name' => 'West Sulawesi'],
            ['name' => 'South Sulawesi'],
            ['name' => 'Central Sulawesi'],
            ['name' => 'Southeast Sulawesi'],
            ['name' => 'North Sulawesi'],
            ['name' => 'Maluku'],
            ['name' => 'North Maluku'],
            ['name' => 'West Papua'],
            ['name' => 'Papua'],
            ['name' => 'Bengkulu'],
            ['name' => 'Jambi'],
            ['name' => 'Bangka Belitung'],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}
