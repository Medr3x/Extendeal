<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaintingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'code' => $this->faker->postcode,
            'painter' => $this->faker->lastName,
            'country' => $this->faker->country,
            'publication_date' => $this->faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null),
            'status' => '1',
            'relevance' => $this->faker->numberBetween(1, 9999),
            'created_by' => 1,
            'updated_by' => 1
        ];
    }
}
