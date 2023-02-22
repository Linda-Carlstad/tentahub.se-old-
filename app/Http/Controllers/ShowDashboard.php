<?php

namespace App\Http\Controllers;

use App\User;
use App\Association;
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
            return view('dashboard.index');
        }
        $total = Association::all()->where('public', true)->count();
        return view( 'general.welcome' )->with('total', $total);
    }
}
