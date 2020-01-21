<?php

namespace App\Http\Controllers;

use App\User;
use App\University;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'verified' );
        $this->middleware( 'valid_user' )->except( 'settings', 'update' );
        $this->middleware( 'admin' )->only( 'create', 'store', 'edit', 'show', 'destroy' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function index()
    {
        $users = User::all();
        $this->authorize( 'view', Auth::user() );

        return view( 'users.index' )->with( 'users', $users );;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $user = Auth::user();
        $this->authorize( 'create', $user );

        $universities = University::with( 'associations' )->get();

        return view( 'users.create' )->with( 'user', $user )->with( 'universities', $universities );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->authorize( 'store', $user );

        User::createNew( $request );

        return redirect( 'users' )->with( 'success', 'Ny användare skapad!' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show( $id )
    {
        $user = User::findOrFail( $id );
        return view( 'users.show' )->with( 'user', $user );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit( $id )
    {
        $user = User::findOrFail( $id );
        $this->authorize( 'edit', Auth::user(), $user );
        $universities = University::with( 'associations' )->get();
        return view( 'users.edit' )->with( 'user', $user )->with( 'universities', $universities );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update( Request $request, $id )
    {
        $user = User::findOrFail( $id );
        $this->authorize( 'update', Auth::user(), $user );

        switch( $request->type )
        {
            case 'info':
                if( $user->valid )
                {
                    $result = User::updateInfo( $request, $user );
                }
                else
                {
                    $result = false;
                }
                break;

            case 'security':
                $result = User::updateSecurity( $request, $user );
                break;

            case 'admin':
                $result = User::updateAdmin( $request, $user );
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
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy( $id )
    {
        $user = User::findOrFail( $id );
        $this->authorize( 'delete', Auth::user(), $user );
        $user->delete();

        return redirect( 'users' )->with( 'success', 'Användare borttagen.' );
    }

    /**
     * Display the current logged in user.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function profile()
    {
        $user = Auth::user();
        $this->authorize( 'view', Auth::user() );
        return view( 'users.profile' )->with( 'user', $user );
    }

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
