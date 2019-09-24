<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    private $auth;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->auth = auth()->user() ? (
            auth()->user()->role === 'admin' ||
            auth()->user()->role === 'super' ) : false;


        if( $this->auth )
        {
            return $next($request);
        }

        return redirect()->route( 'login' )->with( 'error', 'Access denied, login to continue.' );
    }
}
