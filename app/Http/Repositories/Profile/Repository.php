<?php

namespace App\Http\Repositories\Profile;

use App\Models\User;

final class Repository implements Contracts\Repository
{
    /**
     * @param User $user
     *
     * @return array
     */
    public function getProfile(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
    }
}
