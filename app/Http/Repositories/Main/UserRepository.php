<?php

namespace App\Http\Repositories\Main;

use App\Models\User;

final class UserRepository implements Contracts\UserRepository
{
    /**
     * @var User
     */
    protected User $model;

    /**
     * @param User $model
     *
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param User $user
     *
     * @return array
     */
    public function getUser(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function getUsers(array $attributes): array
    {
        return $this->model->filter($attributes)->get()->map(fn (User $user) => $this->getUser($user))->all();
    }
}
