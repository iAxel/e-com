<?php

namespace App\Modules;

use Throwable;

use App\Models\Token;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

final class Olympus implements Guard
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var UserProvider
     */
    protected UserProvider $provider;

    /**
     * @var Authenticatable|null
     */
    protected ?Authenticatable $user = null;

    /**
     * @param Request $request
     * @param UserProvider $provider
     *
     * @return void
     */
    public function __construct(Request $request, UserProvider $provider)
    {
        $this->request = $request;

        $this->provider = $provider;

        $this->user = null;
    }

    /**
     * @return bool
     */
    public function check(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return bool
     */
    public function guest(): bool
    {
        return $this->user() === null;
    }

    /**
     * @return Authenticatable|null
     */
    public function user(): ?Authenticatable
    {
        if ($this->user) {
            return $this->user;
        }

        $value = $this->getTokenValue();

        if (!$value) {
            return null;
        }

        $token = Token::findByValue($value)->first();

        if (!$token) {
            return null;
        }

        $dateNow = Carbon::now();

        if ($dateNow >= $token->expired_at) {
            try {
                $token->delete();
            } catch (Throwable) {
                return null;
            }

            return null;
        }

        try {
            $token->update(['used_at' => $dateNow]);
        } catch (Throwable) {
            return null;
        }

        $user = $this->provider->retrieveById($token->user_id);

        if (!$user) {
            return null;
        }

        $this->setUser($user);

        return $this->user;
    }

    /**
     * @return int|string|null
     */
    public function id(): int|string|null
    {
        $user = $this->user();

        if ($user) {
            return $user->getAuthIdentifier();
        }

        return null;
    }

    /**
     * @param array $credentials
     *
     * @return bool
     */
    public function validate(array $credentials = []): bool
    {
        $user = $this->provider->retrieveByCredentials($credentials);

        if (!$user) {
            return false;
        }

        $validated = $this->provider->validateCredentials($user, $credentials);

        if (!$validated) {
            return false;
        }

        $this->setUser($user);

        return true;
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        $value = $this->getTokenValue();

        if (!$value) {
            return;
        }

        $check = $this->check();

        if (!$check) {
            return;
        }

        Token::findByValue($value)->delete();

        $this->user = null;
    }

    /**
     * @param Authenticatable $user
     *
     * @return void
     */
    public function setUser(Authenticatable $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string|null
     */
    private function getTokenValue(): ?string
    {
        $token = $this->request->bearerToken();

        if (!$token) {
            $token = $this->request->query('token');
        }

        if (!$token) {
            $token = $this->request->input('token');
        }

        return $token;
    }
}
