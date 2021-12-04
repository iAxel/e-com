<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\Request;

final class SessionRequest extends Request
{
    /**
     * @var string
     */
    protected string $tokenKey = 'token';

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function getCurrentToken(): string
    {
        $token = $this->bearerToken();

        if (!$token) {
            $token = $this->query($this->tokenKey);
        }

        if (!$token) {
            $token = $this->input($this->tokenKey);
        }

        return $token;
    }
}
