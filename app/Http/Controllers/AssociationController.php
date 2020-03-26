<?php

namespace App\Http\Controllers;

use App\Association;

use App\Course;
use App\University;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AssociationController extends Controller
{
    public function __construct()
    {
        $guest = [ 'index', 'show', 'full' ];
        $auth = [ 'edit', 'update' ];
        $admin = [ 'create', 'store', 'destroy' ];

        $this->middleware( 'verified' )->except( $guest );
        $this->middleware( 'valid_user' )->except( $guest );
        $this->middleware( 'moderator' )->only( $auth );
        $this->middleware( 'admin' )->only( $admin );
    }

     /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */

    public function index()
    {
        //$total = Association::all()->count();
        $associations = Association::where( 'public', true )->orderBy( 'name', 'asc' )->with( 'university' )->get();

        return view( 'associations.index' )->with( 'associations', $associations );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
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
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store( Request $request )
    {
        $university = University::findOrFail( $request->university_id );
        $this->authorize( 'create', Auth::user(), $university );

        $result = Association::store( $request );

        if( $result[ 0 ] === 'success' )
        {
            $association = $result[ 2 ];
            return redirect()->route( 'associations.show', $association->slug )->with( $result[ 0 ], $result[ 1 ] );
        }

        return redirect()->back()->with( 'error', '' );
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Factory|View
     */
    public function show( $slug )
    {
        $association = Association::where( 'slug', $slug )->with( 'courses' )->first();
        $courses = $association->courses;

        return view( 'associations.show' )->with( 'association', $association )->with( 'courses', $courses );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit( $slug )
    {
        $association = Association::where( 'slug', $slug )->first();
        $this->authorize( 'update', Auth::user(), $association );

        $universities = University::all();

        return view( 'associations.edit' )->with( 'association', $association )->with( 'universities', $universities );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $slug
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update( Request $request, $slug )
    {
        $association = Association::where( 'slug', $slug )->first();
        $this->authorize( 'update', Auth::user(), $association );

        $result = Association::updateAttributes( $request, $association );

        if( $result[ 0 ] === 'success' )
        {
            $association = $result[ 2 ];
            return redirect()->route( 'associations.show', $association->slug )->with( $result[ 0 ], $result[ 1 ] );
        }

        return redirect()->back()->with( 'error', 'Något gick fel i maskineriet, testa igen!' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy( $slug )
    {
        $association = Association::where( 'slug', $slug )->first();
        $this->authorize( 'delete', Auth::user(), $association );

        $association->delete();
        return redirect()->back()->with( 'success', 'Föreningen borttagen, ohh, scary...' );
    }

    // Custom actions

    /**
     * Display the specified resource.
     *
     * @param $university
     * @param $association
     * @return Factory|View
     */
    public function full( $university, $association )
    {
        $association = Association::where( 'slug', $association )->with( 'courses' )->first();
        $courses = $association->courses;

        return view( 'associations.show' )->with( 'association', $association )->with( 'courses', $courses );
    }
}
