<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $recipeIDs = Recipe::pluck('id');
        $userIDs = User::pluck('id');

        return [
            'comment' => $this->faker->text(500),
            'recipe_id' => $recipeIDs->random(),
            'user_id' => $userIDs->random()
        ];
    }
}
