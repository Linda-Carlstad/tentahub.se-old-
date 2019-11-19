<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowDashboard extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if( Auth::check() )
        {
            $this->middleware( 'verified' );
            $user = User::findOrFail( Auth::id() );
            return view('dashboard.index')->with('user', $user);
        }

        return view( 'general.welcome' );
    }
}
