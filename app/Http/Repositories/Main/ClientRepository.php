<?php

namespace App\Http\Repositories\Main;

use App\Models\Order;
use App\Models\Client;
use App\Models\Transaction;

final class ClientRepository implements Contracts\ClientRepository
{
    /**
     * @var Client
     */
    protected Client $model;

    /**
     * @param Client $model
     *
     * @return void
     */
    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    /**
     * @param Client $client
     *
     * @return array
     */
    public function getClient(Client $client): array
    {
        return [
            'id' => $client->id,
            'first_name' => $client->ft_name,
            'last_name' => $client->lt_name,
            'created_at' => $client->created_at,
            'updated_at' => $client->updated_at,
        ];
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function getClients(array $attributes): array
    {
        return $this->model->filter($attributes)->get()->map(fn (Client $client) => $this->getClient($client))->all();
    }

    /**
     * @param Client $client
     *
     * @return array
     */
    public function getOrders(Client $client): array
    {
        $result = $client->orders()->get()->map(fn (Order $order) => [
            'id' => $order->id,
            'date' => $order->date,
        ]);

        return $result->all();
    }

    /**
     * @param Client $client
     *
     * @return array
     */
    public function getTransactions(Client $client): array
    {
        $client->load(['transactions.order']);

        $result = $client->transactions()->get()->map(fn (Transaction $transaction) => [
            'id' => $transaction->id,

            'order' => [
                'id' => $transaction->order->id,
                'date' => $transaction->order->date,
            ],
        ]);

        return $result->all();
    }
}
