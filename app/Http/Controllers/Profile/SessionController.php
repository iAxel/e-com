<?php

namespace App\Http\Controllers\Profile;

use App\Models\Token;

use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller;

use App\Http\Requests\Profile\SessionRequest;

use App\Http\Repositories\Profile\Contracts\SessionRepository;

final class SessionController extends Controller
{
    /**
     * @var SessionRepository
     */
    protected SessionRepository $repository;

    /**
     * @param SessionRepository $repository
     *
     * @return void
     */
    public function __construct(SessionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param SessionRequest $request
     *
     * @return JsonResponse
     */
    public function readAny(SessionRequest $request): JsonResponse
    {
        return response()->json(
            $this->repository->getSessions(
                $request->user(),
                $request->getCurrentToken(),
            ),
        );
    }

    /**
     * @param SessionRequest $request
     * @param Token $token
     *
     * @return JsonResponse
     */
    public function delete(SessionRequest $request, Token $token): JsonResponse
    {
        if ($token->value === $request->getCurrentToken()) {
            return response()->json(['message' => 'Unable to terminate current session.'], 403);
        }

        $this->repository->deleteSession(
            $request->user(),
            $token->value,
        );

        return response()->json(['message' => 'Session terminated successfully.']);
    }

    /**
     * @param SessionRequest $request
     *
     * @return JsonResponse
     */
    public function deleteAll(SessionRequest $request): JsonResponse
    {
        $this->repository->deleteSessions(
            $request->user(),
            $request->getCurrentToken(),
        );

        return response()->json(['message' => 'All other sessions terminated successfully.']);
    }
}
