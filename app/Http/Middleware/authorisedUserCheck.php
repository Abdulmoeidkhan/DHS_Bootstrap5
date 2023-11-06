<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class authorisedUserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authorisedUserRoles = ['admin', 'delegate', 'liason'];
        $isAuthorised = in_array(session()->get('user')->roles[0]->name, $authorisedUserRoles);
        if (!$isAuthorised) {
            return abort(403);
        }
        return $next($request);
    }
}
