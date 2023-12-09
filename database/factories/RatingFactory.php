<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bookIds = \App\Models\Book::pluck('id')->toArray();

        return [
            'book_id' => $this->faker->randomElement($bookIds),
            'score' => $this->faker->numberBetween(1, 10),
        ];
    }
}
