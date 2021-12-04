<?php

namespace App\Http\Controllers\Main;

use App\Models\User;

use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller;

use App\Http\Requests\Main\UserRequest;

use App\Http\Repositories\Main\Contracts\UserRepository;

final class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected UserRepository $repository;

    /**
     * @param UserRepository $repository
     *
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserRequest $request
     *
     * @return JsonResponse
     */
    public function index(UserRequest $request): JsonResponse
    {
        return response()->json(
            $this->repository->getUsers(
                $request->getAttributes(),
            ),
        );
    }

    /**
     * @param User $user
     *
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json(
            $this->repository->getUser($user),
        );
    }
}
