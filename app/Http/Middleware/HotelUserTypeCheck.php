<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HotelUserTypeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userType = array('hotels', 'admin');
        $isHotelUser = in_array(session()->get('user')->roles[0]->name, $userType);
        if (!$isHotelUser) {
            return abort(403);
        }
        return $next($request);
    }
}
