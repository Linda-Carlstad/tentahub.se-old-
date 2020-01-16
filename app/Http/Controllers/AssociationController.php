<?php

namespace App\Http\Controllers;

use App\Association;

use App\Course;
use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssociationController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'verified' )->except( 'index', 'show' );
        $this->middleware( 'valid_user' )->except( 'index', 'show' );
        $this->middleware( 'moderator' )->only( 'edit', 'update' );
        $this->middleware( 'admin' )->only( 'create', 'store', 'destroy' );
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $total = Association::all()->count();
        $associations = Association::orderBy( 'name', 'asc' )->get();

        return view( 'associations.index' )->with( 'associations', $associations );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize( 'create', Auth::user(), Auth::user()->university );
        $universities = University::all();

        return view( 'associations.create' )->with( 'universities', $universities );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( Request $request )
    {
        $university = University::findOrFail( $request->university_id );
        $this->authorize( 'create', Auth::user(), $university );

        $result = Association::store( $request );

        if( $result[ 0 ] === 'success' )
        {
            $association = $result[ 2 ];
            return redirect()->route( 'associations.show', $association->id )->with( $result[ 0 ], $result[ 1 ] );
        }

        return redirect()->back()->with( 'error', '' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show( $id )
    {
        $association = Association::findOrFail( $id );
        $courses = $association->courses;

        return view( 'associations.show' )->with( 'association', $association )->with( 'courses', $courses );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $association = Association::findOrFail( $id );
        $this->authorize( 'update', Auth::user(), $association );

        $universities = University::all();

        return view( 'associations.edit' )->with( 'association', $association )->with( 'universities', $universities );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $association = Association::findOrFail( $id );
        $this->authorize( 'update', Auth::user(), $association );

        $result = Association::updateAttributes( $request, $association );

        if( $result[ 0 ] === 'success' )
        {
            $association = $result[ 2 ];
            return redirect()->route( 'associations.show', $association->id )->with( $result[ 0 ], $result[ 1 ] );
        }

        return redirect()->back()->with( 'error', 'Något gick fel i maskineriet, testa igen!' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $association = Association::findOrFail( $id );
        $this->authorize( 'delete', Auth::user(), $association );

        $association->delete();
        return redirect()->back()->with( 'success', 'Föreningen borttagen, ohh, scary...' );
    }
}
