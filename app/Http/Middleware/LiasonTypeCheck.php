<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LiasonTypeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isLiason = session()->get('user')->roles[0]->name === 'liason' ? true : false;

        if (!$isLiason) {
            return abort(403);
        }
        return $next($request);
    }
}
