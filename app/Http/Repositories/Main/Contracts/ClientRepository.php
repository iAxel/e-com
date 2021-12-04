<?php

namespace App\Http\Repositories\Main\Contracts;

use App\Models\Client;

interface ClientRepository
{
    /**
     * @param Client $client
     *
     * @return array
     */
    public function getClient(Client $client): array;

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function getClients(array $attributes): array;

    /**
     * @param Client $client
     *
     * @return array
     */
    public function getOrders(Client $client): array;

    /**
     * @param Client $client
     *
     * @return array
     */
    public function getTransactions(Client $client): array;
}
