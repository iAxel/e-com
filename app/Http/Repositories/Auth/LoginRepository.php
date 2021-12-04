<?php

namespace App\Http\Repositories\Auth;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

final class LoginRepository implements Contracts\LoginRepository
{
    /**
     * @param array $credentials
     *
     * @return bool
     */
    public function userAttempt(array $credentials): bool
    {
        return Auth::validate($credentials);
    }

    /**
     * @param User $user
     * @param array $userData
     *
     * @return array
     */
    public function createTokenForUser(User $user, array $userData): array
    {
        $token = $user->createToken($userData);

        return [
            'token' => $token->value,
            'expired_at' => $token->expired_at,
        ];
    }
}
