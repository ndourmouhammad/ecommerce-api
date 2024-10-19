<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Modele>
 */
class ModeleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->paragraph(),
            'marque_id' => $this->faker->numberBetween(1, 10),
            'caracteristiques' => json_encode([
                'feature1' => 'Nihil consequuntur itaque consequatur totam deserunt numquam quia.',
                'feature2' => 'Debitis nostrum officia aperiam fuga labore nihil.',
                'feature3' => 'Possimus quisquam sunt pariatur minima ex aperiam et.',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
