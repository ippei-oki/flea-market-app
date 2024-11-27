<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConditionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'condition' => $this->faker->randomElement(['New', 'Used', 'Refurbished']),
        ];
    }
}
