<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Request;

use Illuminate\Http\Middleware\TrustProxies as Middleware;

final class TrustProxies extends Middleware
{
    /**
     * @var array|string|null
     */
    protected $proxies;

    /**
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_HOST | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO | Request::HEADER_X_FORWARDED_AWS_ELB;
}