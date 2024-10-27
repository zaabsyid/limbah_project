<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\KategoriLimbah;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriLimbahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'Plastic Waste'],
            ['name' => 'Electronic Waste'],
            ['name' => 'Hazardous Waste'],
            ['name' => 'Organic Waste'],
            ['name' => 'Metal Scrap'],
            // Add more categories as needed
        ];

        foreach ($categories as $category) {
            KategoriLimbah::create([
                'name' => $category['name'],
                'code' => $this->generateRandomCode(),
            ]);
        }
    }

    /**
     * Generate a unique random code.
     *
     * @return string
     */
    private function generateRandomCode()
    {
        return 'KW-' . Str::upper(Str::random(6));
    }
}
