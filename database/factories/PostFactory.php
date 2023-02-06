<?php

namespace Database\Factories;

use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
       
        $title = $this->faker->realText(20);
        $slug = Str::slug($title,'-', null);
        return [
            'title' => $title,
            'preview'=>$this->faker->realText(800),
            'slug' => $slug,
            'body' => $this->faker->realText(),
            'tags' => 'php,python,asp.net,chart,video,mac',
            'active'=>$this->faker->boolean(),
        ];
    }
}
