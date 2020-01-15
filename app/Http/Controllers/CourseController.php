<?php

namespace App\Http\Controllers;

use App\Association;
use App\Course;

use App\Exam;
use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'verified' )->except( 'index', 'show' );
        $this->middleware( 'valid_user' )->except( 'index', 'show' );
        $this->middleware( 'moderator' )->except( 'index', 'show' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy( 'name', 'asc' )->get();

        return view( 'courses.index' )->with( 'courses', $courses );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize( 'create', Auth::user(), Auth::user()->association );
        $universities = University::all();

        return view( 'courses.create' )->with( 'universities', $universities );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $ascociation = Association::findOrFail( $request->association_id );
        $this->authorize( 'create', Auth::user(), $ascociation );

        $result = Course::store( $request );
        if( $result )
        {
            $course = $result[ 2 ];
            return redirect()->route( 'courses.show', $course->id )->with( $result[ 0 ], $result[ 1 ] );
        }

        return redirect()->back()->with( $result[ 0 ], $result[ 1 ] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $course = Course::findOrFail( $id );
        $exams = $course->exams;

        return view( 'courses.show' )->with( 'course', $course )->with( 'exams', $exams );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail( $id );
        $this->authorize( 'update', Auth::user(), $course );

        $associations = Association::all();
        $universities = University::all();

        return view( 'courses.edit' )->with( 'course', $course )->with( 'associations', $associations )->with( 'universities', $universities );
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
        $course = Course::findOrFail( $id );
        $this->authorize( 'update', Auth::user(), $course );

        $result = Course::updateAttributes( $request, $id );

        if( $result )
        {
            $course = $result[ 2 ];
            return redirect()->route( 'courses.show', $course->id )->with( $result[ 0 ], $result[ 1 ] );
        }

        return redirect()->back()->with( $result[ 0 ], $result[ 1 ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail( $id );
        $this->authorize( 'delete', Auth::user(), $course );

        $course->delete();

        return redirect()->route( 'courses.index' )->with( 'success', 'Kurs borttagen, ohh, scary...' );
    }
}
