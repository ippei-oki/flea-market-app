<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Condition;

class ItemFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'brand' => $this->faker->company,
            'price' => $this->faker->numberBetween(100, 10000),
            'image' => 'item_images/sample.jpg',
            'explanation' => $this->faker->sentence,
            'condition_id' => Condition::factory(), // Conditionとのリレーション
        ];
    }
}
