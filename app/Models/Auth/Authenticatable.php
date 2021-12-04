<?php

namespace App\Models\Auth;

trait Authenticatable
{
    /**
     * @var string|null
     */
    protected ?string $rememberTokenName = null;

    /**
     * @return string
     */
    public function getAuthIdentifierName(): string
    {
        return $this->getKeyName();
    }

    /**
     * @return mixed
     */
    public function getAuthIdentifier(): mixed
    {
        return $this->${$this->getAuthIdentifierName()};
    }

    /**
     * @return string
     */
    public function getAuthPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getRememberToken(): ?string
    {
        return null;
    }

    /**
     * @param string $value
     */
    public function setRememberToken($value): void
    {
        //
    }

    /**
     * @return string|null
     */
    public function getRememberTokenName(): ?string
    {
        return $this->rememberTokenName;
    }
}
