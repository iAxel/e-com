<?php

namespace App\Http\Repositories\Auth\Contracts;

use App\Models\User;

interface LoginRepository
{
    /**
     * @param array $credentials
     *
     * @return bool
     */
    public function userAttempt(array $credentials): bool;

    /**
     * @param User $user
     * @param array $userData
     *
     * @return array
     */
    public function createTokenForUser(User $user, array $userData): array;
}
