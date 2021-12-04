<?php

namespace App\Http\Middleware\Traits;

trait HasGuards
{
    /**
     * @param array $guards
     *
     * @return bool
     */
    private function hasGuards(array $guards): bool
    {
        return count($guards) > 0;
    }
}
