<?php

namespace Database\Factories;

use App\Models\Weight;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Weight>
 */
class WeightFactory extends Factory
{
    protected $model = Weight::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'weight_date' => fake()->date(),
            'weight' => fake()->randomFloat(),
            'comment' => fake()->text(),
        ];
    }
}
