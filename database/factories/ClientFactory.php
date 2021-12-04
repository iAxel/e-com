<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class ClientFactory extends Factory
{
    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'ft_name' => $this->faker->firstName(),
            'lt_name' => $this->faker->lastName(),
        ];
    }
}
