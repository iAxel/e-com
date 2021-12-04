<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller;

use App\Http\Requests\Auth\LoginRequest;

use App\Http\Repositories\Auth\Contracts\LoginRepository;

final class LoginController extends Controller
{
    /**
     * @var LoginRepository
     */
    protected LoginRepository $repository;

    /**
     * @param LoginRepository $repository
     *
     * @return void
     */
    public function __construct(LoginRepository $repository)
    {
        $this->repository = $repository;

        $this->middleware('guest');
    }

    /**
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $attempt = $this->repository->userAttempt(
            $request->getCredentials(),
        );

        if (!$attempt) {
            return response()->json(['message' => 'These credentials do not match our records.'], 401);
        }

        return response()->json(
            $this->repository->createTokenForUser(
                $request->user(),
                $request->userData(),
            )
        );
    }
}
