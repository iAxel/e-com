<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller;

use App\Http\Repositories\Auth\Contracts\LogoutRepository;

final class LogoutController extends Controller
{
    /**
     * @var LogoutRepository
     */
    protected LogoutRepository $repository;

    /**
     * @param LogoutRepository $repository
     *
     * @return void
     */
    public function __construct(LogoutRepository $repository)
    {
        $this->repository = $repository;

        $this->middleware('auth:api');
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $this->repository->logoutUser();

        return response()->json(['message' => 'You have been successfully logged out.']);
    }
}
