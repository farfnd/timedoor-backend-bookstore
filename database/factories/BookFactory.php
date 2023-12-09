<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $authorIds = \App\Models\Author::pluck('id')->toArray();
        $categoryIds = \App\Models\Category::pluck('id')->toArray();

        return [
            'name' => $this->faker->sentence(3),
            'author_id' => $this->faker->randomElement($authorIds),
            'category_id' => $this->faker->randomElement($categoryIds),
        ];
    }
}
