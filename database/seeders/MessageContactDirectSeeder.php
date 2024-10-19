<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MessageContactDirect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageContactDirectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MessageContactDirect::create([
            'email_proprietaire' => 'user1@example.com',
            'sujet_message' => 'Problème de connexion',
            'text' => 'Je rencontre des difficultés à me connecter à mon compte.',
            'piece_jointe' => 'document.pdf',
        ]);

        MessageContactDirect::create([
            'email_proprietaire' => 'user2@example.com',
            'sujet_message' => 'Demande d\'information',
            'text' => 'Pouvez-vous me fournir plus d\'informations sur les services proposés ?',
            'piece_jointe' => null,
        ]);
    }
}
