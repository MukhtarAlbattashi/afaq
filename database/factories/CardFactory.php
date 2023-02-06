<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CardFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'coins' => $this->faker->numberBetween(1,100),
            'available' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'hide' => $this->faker->boolean(),
        ];
    }
}
