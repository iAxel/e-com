<?php

namespace App\Http;

use App\Http\Middleware\Auth;
use App\Http\Middleware\Guest;
use App\Http\Middleware\TrustHosts;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\TrustProxies;

use Fruitcake\Cors\HandleCors;

use Illuminate\Foundation\Http\Kernel as BaseKernel;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

use Illuminate\Routing\Middleware\SubstituteBindings;

final class Kernel extends BaseKernel
{
    /**
     * @var array
     */
    protected $middleware = [
        TrustHosts::class,
        TrustProxies::class,
        HandleCors::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * @var array
     */
    protected $middlewareGroups = [
        'api' => [
            SubstituteBindings::class,
        ],
    ];

    /**
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Auth::class,
        'guest' => Guest::class,
    ];
}
