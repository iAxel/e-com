<?php

namespace App\Http\Repositories\Main\Contracts;

use App\Models\User;

interface UserRepository
{
    /**
     * @param User $user
     *
     * @return array
     */
    public function getUser(User $user): array;

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function getUsers(array $attributes): array;
}
