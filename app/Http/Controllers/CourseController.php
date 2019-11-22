<?php

namespace App\Http\Controllers;

use App\Association;
use App\Course;

use App\Exam;
use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
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
        $course = Course::store( $request );

        if( $course )
        {
            return redirect()->route( 'courses.show', $course->id )->with( 'success', 'Ny kurs tillagd, bra jobbat!' );
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
        $course = Course::updateAttributes( $request, $id );

        if( $course )
        {
            return redirect()->route( 'courses.show', $course->id )->with( 'success', 'Ändring av uppgifterna lyckades, yay!' );
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
        $course = Course::findOrFail( $id );

        $course->delete();
        return redirect()->back()->with( 'success', 'Kurs borttagen, ohh, scary...' );
    }
}
