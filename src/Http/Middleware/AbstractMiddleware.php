<?php

namespace ApiArchitect\Compass\Http\Middleware;

use Closure;

abstract class AbstractMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    abstract public function handle($request, Closure $next);
}
