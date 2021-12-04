<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\JsonResponse;

use App\Http\Requests\Profile\Request;

use App\Http\Repositories\Profile\Contracts\Repository;

use Illuminate\Routing\Controller as BaseController;

final class Controller extends BaseController
{
    /**
     * @var Repository
     */
    protected Repository $repository;

    /**
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(
            $this->repository->getProfile(
                $request->user(),
            ),
        );
    }
}
