<?php

namespace App\Http\Controllers;

use View;
use Session;

use App\User;
use App\University;
use App\Association;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'verified' );
        $this->middleware( 'valid_user' )->except( 'edit', 'update' );
        $this->middleware( 'admin' )->only( 'create', 'store', 'show', 'destroy' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail( Auth::user()->id );
        $this->authorize( 'view', Auth::user(), $user );

        return view( 'users.index' )->with( 'user', $user );;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort( '404' );
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
    public function show( $id )
    {
        $user = User::findOrFail( $id );
        return view( 'users.show' )->with( 'user', $user );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Request $request )
    {
        $user = User::findOrFail( Auth::user()->id );
        return view( 'users.edit' )->with( 'user', $user );
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
        $result = false;

        switch( $request->type )
        {
            case 'info':
                if( $user->valid )
                {
                    $result = User::updateInfo( $request, $user );
                }
                break;

            case 'security':
                $result = User::updateSecurity( $request, $user );
                break;

            default:
                $result = false;
                break;
        }

        if( $result )
        {
            return redirect()->back()->with( 'success', 'Profil uppdaterad.' );
        }
        return redirect()->back()->with( 'error', 'Något gick fel.' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        abort( '403' );

    /**
     * Show the update form for the current logged in user.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function settings()
    {
        $user = Auth::user();
        $this->authorize( 'edit', Auth::user(), $user );
        return view( 'users.settings' )->with( 'user', $user );
    }
}
