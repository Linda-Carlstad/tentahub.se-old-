<?php

namespace App\Http\Controllers;

use App\University;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UniversityController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'verified' )->except( 'index', 'show' );
        $this->middleware( 'valid_user' )->except( 'index', 'show' );
        $this->middleware( 'super' )->except( 'index', 'show' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $universities = University::orderBy( 'name', 'asc' )->get();

        return view( 'universities.index' )->with( 'universities', $universities );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize( 'create', Auth::user() );
        return view( 'universities.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store( Request $request )
    {
        $this->authorize( 'create', Auth::user() );
        $result = University::store( $request );

        if( $result[ 0 ] === 'success' )
        {
            $university = $result[ 2 ];
            return redirect()->route( 'universities.show', $university->id )->with( $result[ 0 ], $result[ 1 ] );
        }

        return redirect()->back()->with( 'error', 'Något gick fel i maskineriet, testa igen!' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show( $id )
    {
        $university = University::findOrFail( $id )->with( 'associations' )->get();
        $associations = $university->associations;

        return view( 'universities.show' )->with( 'university', $university )->with( 'associations', $associations );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit($id)
    {
        $university = University::findOrFail( $id );
        $this->authorize( 'update', Auth::user(), $university );

        return view( 'universities.edit' )->with( 'university', $university );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $university = University::findOrFail( $id );
        $this->authorize( 'update', Auth::user(), $university );

        $result = University::updateAttributes( $request, $university );

        if( $result[ 0 ] === 'success' )
        {
            return redirect()->route( 'universities.show', $university->id )->with( $result[ 0 ], $result[ 1 ] );
        }

        return redirect()->back()->with( $result[ 0 ], $result[ 1 ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize( 'delete', Auth::user() );
        $university = University::findOrFail( $id );

        $university->delete();
        return redirect( 'universities' )->with( 'success', 'Universitet borttaget, ohh, scary...' );
    }
}
