<?php

namespace Database\Seeders;

use App\Models\Marque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Marque::create([
            'libelle' => 'Apple',
            'description' => 'Apple Inc. est une entreprise américaine qui conçoit et commercialise des produits électroniques, des logiciels et des ordinateurs.',
        ]);

        Marque::create([
            'libelle' => 'Samsung',
            'description' => 'Samsung est un conglomérat sud-coréen spécialisé dans l\'électronique et la fabrication de produits électroménagers.',
        ]);

        Marque::create([
            'libelle' => 'Xiaomi',
            'description' => 'Xiaomi est une entreprise chinoise qui fabrique des smartphones, des appareils électroniques et d\'autres produits connectés.',
        ]);

        Marque::create([
            'libelle' => 'Huawei',
            'description' => 'Huawei est une société chinoise spécialisée dans la fabrication de télécommunications et d\'équipements électroniques.',
        ]);
    }
}
