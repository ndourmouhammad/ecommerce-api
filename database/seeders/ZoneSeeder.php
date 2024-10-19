<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Zone::create([
            'libelle' => 'Dakar centre ville',
            'tarif' => 2000,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Zone::create([
            'libelle' => 'Dakar Banlieu',
            'tarif' => 3000,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Zone::create([
            'libelle' => 'Hors de Dakar',
            'tarif' => 5000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
