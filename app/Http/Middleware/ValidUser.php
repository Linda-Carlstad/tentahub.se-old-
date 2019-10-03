<?php

namespace App\Http\Middleware;

use Closure;

class ValidUser
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
        $user = $request->user();

        if( $user->valid )
        {
            return $next( $request );
        }

        return redirect()->route( 'profile' )->with( 'error', 'Du måste byta lösenord för att fortsätta.' );
    }
}
