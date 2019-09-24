<?php

namespace App\Http\Middleware;

use Closure;

class Moderator
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
        $this->auth = auth()->user() ? (
            auth()->user()->role === 'moderator' ||
            auth()->user()->role === 'admin' || 
            auth()->user()->role === 'super' ) : false ;

        if( $this->auth === true )
        {
            return $next($request);
        }

        return redirect()->route( 'login' )->with( 'error', 'Access denied, login to continue.' );
    }
}
