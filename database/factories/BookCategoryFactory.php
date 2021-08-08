<?php

namespace Database\Factories;

use App\Models\BookCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'book_id' => $this->faker->numberBetween(1, 30),
            'category_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
