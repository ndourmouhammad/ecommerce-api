<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'libelle_et_reponse' => json_encode([
                'question' => 'Comment créer un compte ?',
                'reponse' => 'Pour créer un compte, cliquez sur le bouton Inscription et suivez les instructions.'
            ]),
        ]);

        Faq::create([
            'libelle_et_reponse' => json_encode([
                'question' => 'Comment réinitialiser mon mot de passe ?',
                'reponse' => 'Cliquez sur Mot de passe oublié et suivez les instructions pour réinitialiser votre mot de passe.'
            ]),
        ]);
    }
}
