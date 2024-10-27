<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Banda Aceh', 'province_id' => Province::where('name', 'Aceh')->first()->id],
            ['name' => 'Denpasar', 'province_id' => Province::where('name', 'Bali')->first()->id],
            ['name' => 'Serang', 'province_id' => Province::where('name', 'Banten')->first()->id],
            ['name' => 'Jakarta', 'province_id' => Province::where('name', 'Jakarta')->first()->id],
            ['name' => 'Bandung', 'province_id' => Province::where('name', 'West Java')->first()->id],
            ['name' => 'Semarang', 'province_id' => Province::where('name', 'Central Java')->first()->id],
            ['name' => 'Surabaya', 'province_id' => Province::where('name', 'East Java')->first()->id],
            // Add more cities as needed
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
