<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Transaction;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

final class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'owner',
            'email' => 'owner@app.io',
            'password' => Hash::make('secret'),
        ]);

        User::factory()->count(99)->create();

        Client::factory()->count(100)->has(
            Order::factory()->count(3)->has(
                Transaction::factory()->count(5),
            )
        )->create();
    }
}
