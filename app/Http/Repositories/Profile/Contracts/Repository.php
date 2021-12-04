<?php

namespace App\Http\Repositories\Profile\Contracts;

use App\Models\User;

interface Repository
{
    /**
     * @param User $user
     *
     * @return array
     */
    public function getProfile(User $user): array;
}
