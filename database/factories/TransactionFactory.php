<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class TransactionFactory extends Factory
{
    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'order_id' => null,
        ];
    }
}
