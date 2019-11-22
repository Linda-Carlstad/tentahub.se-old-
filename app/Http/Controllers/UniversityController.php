<?php

namespace App\Http\Controllers;

use App\University;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universites = University::orderBy( 'name', 'asc' )->get();

        return view( 'universities.index' )->with( 'universites', $universites );
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
        $university = University::store( $request );

        if( $university )
        {
            return redirect()->route( 'universities.show', $university->id )->with( 'success', 'Nytt universitet tillagt, bra jobbat!' );
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
        $university = University::findOrFail( $id );
        $associations = $university->associations;

        return view( 'universities.show' )->with( 'university', $university )->with( 'associations', $associations );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $university = University::findOrFail( $id );

        return view( 'universities.edit' )->with( 'university', $university );
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
        $university = University::updateAttributes( $request, $id );

        if( $university )
        {
            return redirect()->route( 'universities.show', $university->id )->with( 'success', 'Ändring av uppgifterna lyckades, yay!' );
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
        $university = University::findOrFail( $id );

        $university->delete();
        return redirect()->back()->with( 'success', 'Universitet borttaget, ohh, scary...' );
    }
}
