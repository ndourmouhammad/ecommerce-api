<?php

namespace Database\Seeders;

use App\Models\Temoignage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TemoignageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Temoignage::create([
            'text' => 'Excellent service, je recommande vivement !',
            'image_path' => null,
            'date_publication' => now(),
            'statut' => 'approuve',
        ]);

        Temoignage::create([
            'text' => 'Le service pourrait être amélioré à certains égards.',
            'image_path' => null,
            'date_publication' => now(),
            'statut' => 'non_approuve',
        ]);
    }
}
