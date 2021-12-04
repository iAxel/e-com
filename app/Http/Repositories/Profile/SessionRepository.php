<?php

namespace App\Http\Repositories\Profile;

use App\Models\User;
use App\Models\Token;

use Jenssegers\Agent\Agent;

final class SessionRepository implements Contracts\SessionRepository
{
    /**
     * @param User $user
     * @param string $value
     *
     * @return array
     */
    public function getSessions(User $user, string $value): array
    {
        $result = $user->tokens()->latest('used_at')->get()->map(fn (Token $session) => [
            'id' => $session->id,
            'agent' => $this->getAgent($session->user_agent),
            'is_current' => $session->value === $value,
            'ip_address' => $session->user_ip,
            'last_active' => $session->used_at?->diffForHumans(),
        ]);

        return $result->all();
    }

    /**
     * @param User $user
     * @param string $value
     *
     * @return void
     */
    public function deleteSession(User $user, string $value): void
    {
        $user->deleteToken($value);
    }

    /**
     * @param User $user
     * @param string $value
     *
     * @return void
     */
    public function deleteSessions(User $user, string $value): void
    {
        $user->deleteTokens($value);
    }

    /**
     * @param string $userAgent
     *
     * @return array
     */
    private function getAgent(string $userAgent): array
    {
        $agent = new Agent(userAgent: $userAgent);

        return [
            'type' => $agent->deviceType(),
            'device' => $agent->device(),
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
        ];
    }
}
