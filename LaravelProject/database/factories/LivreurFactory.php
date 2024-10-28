<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Livreur;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livreur>
 */
class LivreurFactory extends Factory
{
    protected $model = Livreur::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(), // Génère un nom de famille
            'prenom' => $this->faker->firstName(), // Génère un prénom
            'adresse' => $this->faker->address(), // Génère une adresse aléatoire
            'statut_livreur' => $this->faker->randomElement(['Disponible', 'Occupé']), // Statut aléatoire
            'cin'=>$this->faker->text(10),
            'email' => $this->faker->unique()->safeEmail(), // Génère un email unique
            // 'telephone' => $this->faker->numerify('##########'), // Génère un numéro de téléphone de 10 chiffres
            'telephone' => $this->faker->phoneNumber(), // Génère un numéro de téléphone
            'password' => Hash::make('password'), // Génère un mot de passe hashé
            'admin_id' => Admin::factory(), // Génère une référence à un admin
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
