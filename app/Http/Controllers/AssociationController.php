<?php

namespace App\Http\Controllers;

use App\Association;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssociationController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'verified' )->except( 'index', 'show' );
        $this->middleware( 'valid_user' )->except( 'index', 'show' );
        $this->middleware( 'admin' )->except( 'index', 'show' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $associations = Association::orderBy( 'name', 'asc' )->get();

        return view( 'universities.index' )->with( 'associations', $associations );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'universities.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $association = Association::store( $request );

        if( $association )
        {
            return redirect()->route( 'universities.show', $association->id )->with( 'success', 'Ny förening tillagd, va nice!' );
        }

        return redirect()->back()->with( 'error', 'Något gick fel i maskineriet, testa igen!' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $association = Association::findOrFail( $id );

        return view( 'universities.show' )->with( 'association', $association );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $association = Association::findOrFail( $id );

        return view( 'universities.edit' )->with( 'association', $association );
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
        $association = Association::updateAttributes( $request, $id );

        if( $association )
        {
            return redirect()->route( 'universities.show', $association->id )->with( 'success', 'Ändring av uppgifterna lyckades, yippie!' );
        }

        return redirect()->back()->with( 'error', 'Något gick fel i maskineriet, testa igen!' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $association = Association::findOrFail( $id );

        $association->delete();
        return redirect()->back()->with( 'success', 'Föreningen borttagen, ohh, scary...' );
    }
}
