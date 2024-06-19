<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->segment(1) === "en") {
            App::setLocale("en");
        } else if ($request->segment(1) === "pl") {
            App::setLocale("pl");
        }
        return $next($request);
    }
}
