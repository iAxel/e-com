<?php

namespace App\Http\Repositories\Auth;

use Illuminate\Support\Facades\Auth;

final class LogoutRepository implements Contracts\LogoutRepository
{
    /**
     * @return void
     */
    public function logoutUser(): void
    {
        Auth::logout();
    }
}
