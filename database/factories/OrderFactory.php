<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'message' => $this->faker->word(),
            'completed' => $this->faker->boolean(),
            'decline' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => User::factory(),
            'card_id' => Card::factory(),
        ];
    }
}
