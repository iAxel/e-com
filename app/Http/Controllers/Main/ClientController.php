<?php

namespace App\Http\Controllers\Main;

use App\Models\Client;

use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller;

use App\Http\Requests\Main\ClientRequest;

use App\Http\Repositories\Main\Contracts\ClientRepository;

final class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    protected ClientRepository $repository;

    /**
     * @param ClientRepository $repository
     *
     * @return void
     */
    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ClientRequest $request
     *
     * @return JsonResponse
     */
    public function index(ClientRequest $request): JsonResponse
    {
        return response()->json(
            $this->repository->getClients(
                $request->getAttributes(),
            ),
        );
    }

    /**
     * @param Client $client
     *
     * @return JsonResponse
     */
    public function show(Client $client): JsonResponse
    {
        return response()->json(
            $this->repository->getClient($client),
        );
    }

    /**
     * @param Client $client
     *
     * @return JsonResponse
     */
    public function orders(Client $client): JsonResponse
    {
        return response()->json(
            $this->repository->getOrders($client),
        );
    }

    /**
     * @param Client $client
     *
     * @return JsonResponse
     */
    public function transactions(Client $client): JsonResponse
    {
        return response()->json(
            $this->repository->getTransactions($client),
        );
    }
}
