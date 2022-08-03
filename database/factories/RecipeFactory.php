<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(30),
            'photo_path' => 'https://picsum.photos/800/600',
            'total_time' => $this->faker->numberBetween(10,300),
            'ingredients' => $this->faker->text(250),
            'instructions' => $this->faker->text(500),
//            'category_id' => $categoryIDs->random()
        ];
    }
}
