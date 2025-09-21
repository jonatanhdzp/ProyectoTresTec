<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $starts_at = $this->faker->date();
        $ends_at = $this->faker->date();

        if ($starts_at > $ends_at)
            [$starts_at, $ends_at] = [$ends_at, $starts_at];

        return [
            'client_id' => Client::factory(),
            'contract_number' => $this->faker->numberBetween(10000, 99999),
            'amount' => $this->faker->numberBetween(100, 10000) * 10,
            'starts_at' => $starts_at,
            'ends_at' => $ends_at
        ];
    }
}
