<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            // Aceh
            ['name' => 'Banda Aceh', 'province_id' => Province::where('name', 'Aceh')->first()->id],
            ['name' => 'Langsa', 'province_id' => Province::where('name', 'Aceh')->first()->id],
            ['name' => 'Lhokseumawe', 'province_id' => Province::where('name', 'Aceh')->first()->id],

            // Bali
            ['name' => 'Denpasar', 'province_id' => Province::where('name', 'Bali')->first()->id],

            // Banten
            ['name' => 'Serang', 'province_id' => Province::where('name', 'Banten')->first()->id],
            ['name' => 'Tangerang', 'province_id' => Province::where('name', 'Banten')->first()->id],
            ['name' => 'Cilegon', 'province_id' => Province::where('name', 'Banten')->first()->id],

            // Jakarta
            ['name' => 'Central Jakarta', 'province_id' => Province::where('name', 'Jakarta')->first()->id],
            ['name' => 'East Jakarta', 'province_id' => Province::where('name', 'Jakarta')->first()->id],
            ['name' => 'South Jakarta', 'province_id' => Province::where('name', 'Jakarta')->first()->id],
            ['name' => 'West Jakarta', 'province_id' => Province::where('name', 'Jakarta')->first()->id],
            ['name' => 'North Jakarta', 'province_id' => Province::where('name', 'Jakarta')->first()->id],

            // West Java
            ['name' => 'Bandung', 'province_id' => Province::where('name', 'West Java')->first()->id],
            ['name' => 'Bogor', 'province_id' => Province::where('name', 'West Java')->first()->id],
            ['name' => 'Bekasi', 'province_id' => Province::where('name', 'West Java')->first()->id],
            ['name' => 'Depok', 'province_id' => Province::where('name', 'West Java')->first()->id],

            // Central Java
            ['name' => 'Semarang', 'province_id' => Province::where('name', 'Central Java')->first()->id],
            ['name' => 'Surakarta', 'province_id' => Province::where('name', 'Central Java')->first()->id],
            ['name' => 'Magelang', 'province_id' => Province::where('name', 'Central Java')->first()->id],

            // East Java
            ['name' => 'Surabaya', 'province_id' => Province::where('name', 'East Java')->first()->id],
            ['name' => 'Malang', 'province_id' => Province::where('name', 'East Java')->first()->id],
            ['name' => 'Kediri', 'province_id' => Province::where('name', 'East Java')->first()->id],

            // Yogyakarta
            ['name' => 'Yogyakarta', 'province_id' => Province::where('name', 'Yogyakarta')->first()->id],

            // North Sumatra
            ['name' => 'Medan', 'province_id' => Province::where('name', 'North Sumatra')->first()->id],
            ['name' => 'Pematangsiantar', 'province_id' => Province::where('name', 'North Sumatra')->first()->id],

            // West Sumatra
            ['name' => 'Padang', 'province_id' => Province::where('name', 'West Sumatra')->first()->id],

            // South Sumatra
            ['name' => 'Palembang', 'province_id' => Province::where('name', 'South Sumatra')->first()->id],

            // Riau
            ['name' => 'Pekanbaru', 'province_id' => Province::where('name', 'Riau')->first()->id],

            // South Sulawesi
            ['name' => 'Makassar', 'province_id' => Province::where('name', 'South Sulawesi')->first()->id],

            // Central Sulawesi
            ['name' => 'Palu', 'province_id' => Province::where('name', 'Central Sulawesi')->first()->id],

            // North Sulawesi
            ['name' => 'Manado', 'province_id' => Province::where('name', 'North Sulawesi')->first()->id],

            // Maluku
            ['name' => 'Ambon', 'province_id' => Province::where('name', 'Maluku')->first()->id],

            // Papua
            ['name' => 'Jayapura', 'province_id' => Province::where('name', 'Papua')->first()->id],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
