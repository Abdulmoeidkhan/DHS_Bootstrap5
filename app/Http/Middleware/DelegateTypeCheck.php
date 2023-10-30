<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DelegateTypeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isDelegate = session()->get('user')->roles[0]->name === 'delegate' ? true : false;

        if (!$isDelegate) {
            return abort(403);
        }
        return $next($request);
    }
}
