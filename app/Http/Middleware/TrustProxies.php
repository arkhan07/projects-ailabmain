<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * Trust ALL proxies (required for Coolify / Caddy)
     *
     * @var array<int, string>|string|null
     */
    protected $proxies = '*';

    /**
     * Use all X-Forwarded headers
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
