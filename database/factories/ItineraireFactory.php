<?php

namespace Database\Factories;

use App\Models\Itineraire;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItineraireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Itineraire::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titre' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'point_depart' => $this->faker->randomNumber(1,8),
            'point_arrivee' => $this->faker->randomNumber(1,8),
            'date' => $this->faker->date,
            'duree' => $this->faker->randomNumber(1,10),
            'category_id' => $this->faker->randomNumber(1,8),
            'user_id' => $this->faker->randomNumber(1,2),
        ];
    }
}
