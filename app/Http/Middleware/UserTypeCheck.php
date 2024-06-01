<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class UserTypeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isAdmin = session()->get('user')->roles[0]->name === 'admin' || session()->get('user')->roles[0]->name === 'dho' || session()->get('user')->roles[0]->name === 'vendor'|| session()->get('user')->roles[0]->name === 'army'|| session()->get('user')->roles[0]->name === 'navy'|| session()->get('user')->roles[0]->name === 'airforce' ?true:false;

        if (!$isAdmin) {
            return abort(403);
        }
        return $next($request);
    }
}
