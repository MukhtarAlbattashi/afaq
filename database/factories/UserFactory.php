<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'coins' => $this->faker->numberBetween(1000,90000),
            'flash' => $this->faker->numberBetween(1000,90000),
            'diamond' => $this->faker->numberBetween(1000,90000),
            'level' => $this->faker->numberBetween(1,100),
            'remember_token' => Str::random(10),
        ];
    }
}
