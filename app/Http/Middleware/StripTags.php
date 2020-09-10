<?php

namespace App\Http\Middleware;

use Closure;

class StripTags
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return is_string($request->all()) ? strip_tags($request->all()) : $request->all();
        return $next($request);
    }
}
