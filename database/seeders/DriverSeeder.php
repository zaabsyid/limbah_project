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
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'phone' => '081234567890',
                'address' => '123 Main St, City A',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'phone' => '081234567891',
                'address' => '456 Elm St, City B',
            ],
            [
                'name' => 'Alex Johnson',
                'email' => 'alexjohnson@example.com',
                'phone' => '081234567892',
                'address' => '789 Oak St, City C',
            ],
            // Add more drivers as needed
        ];

        foreach ($drivers as $driver) {
            Driver::create($driver);
        }
    }
}
