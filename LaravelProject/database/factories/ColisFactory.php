<?php

namespace Database\Factories;

use App\Models\Colis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Colis>
 */
class ColisFactory extends Factory
{
    protected $model = Colis::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_suivi' => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(10)), // Génère un numéro de suivi unique
            'description' => $this->faker->text(200), // Génère une description aléatoire
            'expediteur_id' => \App\Models\Client::factory(), // Génère un expéditeur (client)
            'destinataire_id' => \App\Models\Client::factory(), // Génère un destinataire (client)
            'livreur_id' => \App\Models\Livreur::factory(), // Génère un livreur (optionnel)
            'statut_colis' => $this->faker->randomElement(['En attente', 'En cours', 'Livré']), // Choix aléatoire parmi les statuts possibles
            'poids' => $this->faker->randomFloat(2, 0.1, 100), // Génère un poids aléatoire entre 0.1 et 100 kg
            'prix' => $this->faker->randomFloat(2, 10, 1000), // Génère un prix aléatoire entre 10 et 1000
            'date_livraison' => $this->faker->dateTimeBetween('-1 week', '+1 week'), // Date aléatoire pour la livraison
            'date_reception' => $this->faker->optional()->dateTimeBetween('-1 week', 'now'), // Date de réception (peut être nulle)
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
