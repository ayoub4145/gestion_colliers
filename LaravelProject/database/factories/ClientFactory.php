<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     *
     * @return array<string, mixed>
     */
    protected $model = Client::class;

    protected static ?string $password;

    public function definition(): array
    {
        return [
        'nom' => fake()->lastName(),
        'prenom' => fake()->firstName(), // obtenir un prénom
        'adresse' => fake()->address(), // Ajout de l'appel de méthode pour générer une adresse
        'email' => fake()->unique()->safeEmail(),
        'telephone' => fake()->phoneNumber(), // Correction pour obtenir un numéro de téléphone
        'password' => static::$password ??= Hash::make('password'),

        ];
    }
}
