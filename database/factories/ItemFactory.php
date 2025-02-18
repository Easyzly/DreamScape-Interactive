<?php

namespace Database\Factories;

use App\Models\Rarity;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'rarity_id' => Rarity::inRandomOrder()->first()->id,
            'type_id' => Type::inRandomOrder()->first()->id,
            'power' => $this->faker->numberBetween(1, 100),
            'speed' => $this->faker->numberBetween(1, 100),
            'durability' => $this->faker->numberBetween(1, 100),
            'magic' => $this->faker->word,
        ];
    }
}
