<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class OrderFactory extends Factory
{
    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'client_id' => null,
        ];
    }
}
