<?php

namespace App\Http\Controllers;

use App\User;
use App\University;
use App\Association;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'verified' );
        $this->middleware( 'valid_user' );
        $this->middleware( 'admin' )->except( 'create', 'store', 'destroy' );
        $this->middleware( 'super' )->only( 'create', 'store', 'destroy' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if( $user->role === 'super' )
        {
            $users = User::where( 'role', '<=', $user->role )
                ->orderBy( 'role', 'desc' )
                ->paginate( 20 );
        }
        else
        {
            $users = User::where( 'role', '<=', $user->role )
                ->where( 'association_id', '=', $user->association_id )
                ->orderBy( 'role', 'desc' )
                ->paginate( 20 );
        }

        return view( 'admins.index' )->with( 'users', $users );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::findOrFail( Auth::user()->id );
        $this->authorize( 'create', $user );

        $universities = University::with( 'associations' )->get();

        return view( 'admins.create' )->with( 'user', $user )->with( 'universities', $universities );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail( Auth::user()->id );
        $this->authorize( 'store', $user );

        User::createNew( $request );

        return redirect( 'profil' )->with( 'success', 'Ny användare skapad!' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        abort( '404' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $user = User::findOrFail( $id );
        $universities = University::with( 'associations' )->get();
        return view( 'admins.edit' )->with( 'user', $user )->with( 'universities', $universities );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail( $id );
        $this->authorize( 'update', Auth::user(), $user );

        $result = false;
        $result = User::updateInfo( $request, $user );

        if( $result )
        {
            return redirect()->back()->with( 'success', 'Användare uppdaterad.' );
        }
        return redirect()->back()->with( 'error', 'Något gick fel.' );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail( $id );
        $this->authorize( 'delete', Auth::user(), $user );
        $user->delete();

        return redirect( 'admins' )->with( 'success', 'Användare borttagen.' );
    }
}
