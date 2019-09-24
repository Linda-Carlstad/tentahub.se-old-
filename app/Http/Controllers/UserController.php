<?php

namespace App\Http\Controllers;

use View;
use Session;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail( Auth::user()->id );
        $allowed = $this->authorize( 'view', Auth::user(), $user );

        return view( 'user.index' )->with( 'user', $user );;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::findOrFail( Auth::user()->id );
        $this->authorize( 'create', Auth::user() );

        return view( 'user.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort( '403' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail( $id );
        return view( 'user.show' )->with( 'user', $user );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Request $request )
    {
        return view( 'user.edit' );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $user = User::findOrFail( $id );
        $this->authorize( 'update', Auth::user(), $user );

        switch( $request->type ) {

            case 'info':
                $result = User::updateInfo( $request, $user );
                break;

            case 'security':
                $result = User::updateSecurity( $request, $user );
                break;

            default:

                break;
        }

        if( $result )
        {
            return redirect()->back()->with( 'success', 'Profil uppdaterad.' );
        }
        else {
            return redirect()->back()->with( 'error', 'Något gick fel.' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort( '403' );
    }
}
