<?php

namespace App\Http\Controllers;

use App\Association;
use App\Course;

use App\Exam;
use App\University;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function __construct()
    {
        $list = [ 'index', 'show', 'partial', 'full' ];
        $this->middleware( 'verified' )->except( $list );
        $this->middleware( 'valid_user' )->except( $list );
        $this->middleware( 'moderator' )->except( $list );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $courses = Course::orderBy( 'name', 'asc' )->with( [ 'university', 'association', 'association.university'  ] )->get();

        return view( 'courses.index' )->with( 'courses', $courses );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize( 'create', Auth::user(), Auth::user()->association );
        $universities = University::with( 'associations' )->get();

        return view( 'courses.create' )->with( 'universities', $universities );
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
        $association = Association::findOrFail( $request->association_id );
        $this->authorize( 'create', Auth::user(), $association );

        $result = Course::store( $request );
        if( $result[ 0 ] === 'success' )
        {
            $course = $result[ 2 ];
            return redirect()->route( 'courses.show', $course->slug )->with( $result[ 0 ], $result[ 1 ] );
        }

        return redirect()->back()->with( $result[ 0 ], $result[ 1 ] );
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Factory|View
     */
    public function show( $slug )
    {
        $course = Course::where( 'slug', $slug )->with( 'exams' )->first();
        $exams = $course->exams;

        return view( 'courses.show' )->with( 'course', $course )->with( 'exams', $exams );
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
        $course = Course::where( 'slug', $slug );
        $this->authorize( 'update', Auth::user(), $course );

        $associations = Association::all();
        $universities = University::all();

        return view( 'courses.edit' )->with( 'course', $course )->with( 'associations', $associations )->with( 'universities', $universities );
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
        $course = Course::where( 'slug', $slug );
        $this->authorize( 'update', Auth::user(), $course );

        $result = Course::updateAttributes( $request, $course );

        if( $result[ 0 ] === 'success' )
        {
            $course = $result[ 2 ];
            return redirect()->route( 'courses.show', $course->slug )->with( $result[ 0 ], $result[ 1 ] );
        }

        return redirect()->back()->with( $result[ 0 ], $result[ 1 ] );
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
        $course = Course::where( 'slug', $slug );
        $this->authorize( 'delete', Auth::user(), $course );

        $course->delete();

        return redirect()->route( 'courses.index' )->with( 'success', 'Kurs borttagen, ohh, scary...' );
    }

    // Custom actions

    /**
     * Display the specified resource.
     *
     * @param $university
     * @param $course
     * @return Factory|View
     */
    public function partial( $university, $course )
    {
        $course = Course::where( 'slug', $course )->with( 'exams' )->first();
        $exams = $course->exams;

        return view( 'courses.show' )->with( 'course', $course )->with( 'exams', $exams );
    }

    /**
     * Display the specified resource.
     *
     * @param $university
     * @param $association
     * @param $course
     * @return Factory|View
     */
    public function full( $university, $association, $course )
    {
        $course = Course::where( 'slug', $course )->with( 'exams' )->first();
        $exams = $course->exams;

        return view( 'courses.show' )->with( 'course', $course )->with( 'exams', $exams );
    }
}
