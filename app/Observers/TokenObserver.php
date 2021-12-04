<?php

namespace App\Observers;

use App\Models\Token;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

final class TokenObserver
{
    /**
     * @param Token $token
     *
     * @return void
     */
    public function creating(Token $token): void
    {
        $token->value = $this->createToken($token);

        $token->used_at = Carbon::now();

        $token->expired_at = Carbon::now()->addWeeks(2);
    }

    /**
     * @param Token $token
     *
     * @return string
     */
    private function createToken(Token $token): string
    {
        return hash('sha256', $token->user_id . $token->user_ip . $token->user_agent . Str::random(128));
    }
}
