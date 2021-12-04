<?php

namespace App\Models\Auth\Access;

use Illuminate\Contracts\Auth\Access\Gate;

trait Authorizable
{
    /**
     * @param iterable|string $abilities
     * @param array|mixed $arguments
     *
     * @return bool
     */
    public function can($abilities, $arguments = []): bool
    {
        return app(Gate::class)->forUser($this)->check($abilities, $arguments);
    }
}
