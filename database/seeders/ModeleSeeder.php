<?php

namespace Database\Seeders;

use App\Models\Modele;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModeleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Modele::create([
            'libelle' => 'iPhone 13',
            'description' => 'Le modèle phare d\'Apple avec une puce A15 Bionic et un écran OLED.',
            'caracteristiques' => json_encode([
                'ecran' => '6.1 pouces OLED',
                'processeur' => 'A15 Bionic',
                'RAM' => '4 Go',
                'stockage' => '128 Go',
                'camera' => '12 MPx double caméra',
                'batterie' => '3095 mAh',
                'os' => 'iOS 15'
            ]),
            'marque_id' => 1, // Apple
        ]);

        Modele::create([
            'libelle' => 'Samsung Galaxy S21',
            'description' => 'Le modèle haut de gamme de Samsung avec un écran 120 Hz et un processeur Exynos 2100.',
            'caracteristiques' => json_encode([
                'ecran' => '6.2 pouces AMOLED 120 Hz',
                'processeur' => 'Exynos 2100',
                'RAM' => '8 Go',
                'stockage' => '128 Go',
                'camera' => 'Triple caméra 64 MPx',
                'batterie' => '4000 mAh',
                'os' => 'Android 11'
            ]),
            'marque_id' => 2, // Samsung
        ]);

        Modele::create([
            'libelle' => 'Xiaomi Mi 11',
            'description' => 'Le flagship de Xiaomi avec un écran AMOLED et un processeur Snapdragon 888.',
            'caracteristiques' => json_encode([
                'ecran' => '6.81 pouces AMOLED',
                'processeur' => 'Snapdragon 888',
                'RAM' => '8 Go',
                'stockage' => '256 Go',
                'camera' => '108 MPx triple caméra',
                'batterie' => '4600 mAh',
                'os' => 'MIUI 12.5 basé sur Android 11'
            ]),
            'marque_id' => 3, // Xiaomi
        ]);

        Modele::create([
            'libelle' => 'Huawei P40 Pro',
            'description' => 'Le modèle phare de Huawei avec une caméra Leica et une puce Kirin 990.',
            'caracteristiques' => json_encode([
                'ecran' => '6.58 pouces OLED',
                'processeur' => 'Kirin 990',
                'RAM' => '8 Go',
                'stockage' => '256 Go',
                'camera' => '50 MPx caméra quadruple',
                'batterie' => '4200 mAh',
                'os' => 'EMUI 10.1 basé sur Android 10 sans services Google'
            ]),
            'marque_id' => 4, // Huawei
        ]);
    }
}
