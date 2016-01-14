<?php

namespace App\Http\Middleware;

use Closure;
use Mcamara\LaravelLocalization\LaravelLocalization;

class Localize
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
        app(LaravelLocalization::class)->setLocale();

        return $next($request);
    }
}
