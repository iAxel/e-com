<?php

namespace App\Http\Repositories\Profile\Contracts;

use App\Models\User;

interface SessionRepository
{
    /**
     * @param User $user
     * @param string $value
     *
     * @return array
     */
    public function getSessions(User $user, string $value): array;

    /**
     * @param User $user
     * @param string $value
     *
     * @return void
     */
    public function deleteSession(User $user, string $value): void;

    /**
     * @param User $user
     * @param string $value
     *
     * @return void
     */
    public function deleteSessions(User $user, string $value): void;
}
