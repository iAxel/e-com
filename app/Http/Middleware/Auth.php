<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Factory;

final class Auth
{
    use Traits\HasGuards;

    /**
     * @var Factory
     */
    protected Factory $auth;

    /**
     * @param Factory $auth
     *
     * @return void
     */
    public function __construct(Factory $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @param string ...$guards
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards): mixed
    {
        $hasGuards = $this->hasGuards($guards);

        if (!$hasGuards) {
            $guards = [null];
        }

        $isAuthCheck = false;

        foreach ($guards as $guard) {
            $isAuthCheck = $this->auth->guard($guard)->check();

            if (!$isAuthCheck) {
                continue;
            }

            $this->auth->shouldUse($guard);
        }

        if (!$isAuthCheck) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        return $next($request);
    }
}
