<?php

namespace App\Http\Repositories\Auth\Contracts;

interface LogoutRepository
{
    /**
     * @return void
     */
    public function logoutUser(): void;
}
