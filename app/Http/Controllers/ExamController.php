<?php

namespace App\Http\Controllers;

use App\Course;
use App\Exam;
use App\University;
use App\Verification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ExamController extends Controller
{
    public function __construct()
    {
        $guest = [ 'index', 'show', 'create', 'store', 'download', '', 'full' ];

        $this->middleware( 'verified' )->except( $guest );
        $this->middleware( 'valid_user' )->except( $guest );
        $this->middleware( 'moderator' )->except( $guest );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $exams = Exam::all();

        return view( 'exams.index' )->with( 'exams', $exams );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $universities = University::all();

        return view( 'exams.create' )->with( 'universities', $universities );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store( Request $request )
    {
        /*
        $result = Verification::run( $request, 'recapctha' );
        if( !$result )
        {
            return back()->with( 'error', 'Capatcha fel!' );
        }
        */

        if( $request->type === 'manual' )
        {
            $result = Verification::run( $request, 'exam' );
            if( $result )
            {
                $result = Exam::store( $request );
                return redirect()->route( 'exams.index' )->with( $result[ 0 ], $result[ 1 ] );
            }
            return redirect()->back()->with( $result[ 0 ], $result[ 1 ] );
        }

        if( $request->type === 'automatic' )
        {
            $result = Exam::automaticStore( $request );
            if( $result[ 0 ] === 'success' )
            {
                return redirect()->route('exams.index')->with( $result[ 0 ], $result[ 1 ] );
            }

            return redirect()->back()->with( $result[ 0 ], $result[ 1 ] );
        }

        return redirect()->back()->with( 'error', 'Något gick fel, men vi vet inte vad. Försök igen.' );
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Factory|View
     */
    public function show( $slug )
    {
        $exam = Exam::where(  'slug', $slug )->first();

        return view( 'exams.show' )->with( 'exam', $exam );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return Factory|View
     */
    public function edit( $slug )
    {
        $exam = Exam::where(  'slug', $slug )->first();
        $universities = University::all();

        return view( 'exams.edit' )->with( 'exam', $exam )->with( 'universities', $universities );
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
        $exam = Exam::where(  'slug', $slug )->first();
        $this->authorize( 'update', Auth::user(), $exam );

        $result = Exam::updateAttributes( $request, $slug );

        if( $result[ 0 ] === 'success' )
        {
            return redirect()->route( 'exams.show', $exam->slug )->with( $result[ 0 ], $result[ 1 ] );
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
        $exam = Exam::where(  'slug', $slug )->first();
        $this->authorize( 'delete', Auth::user(), $exam );

        $exam->delete();
        return redirect()->back()->with( 'success', 'Tenta borttagen, waow...' );
    }

    // Custom actions

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return RedirectResponse|Redirector
     */
    public function view( $slug )
    {
        $exam = Exam::where(  'slug', $slug )->first();
        $exam->views += 1;
        $exam->save();

        return redirect( Storage::url( $exam->path ) );
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Factory|View
     */
    public function download( $slug )
    {
        $exam = Exam::where(  'slug', $slug )->first();
        $exam->downloads += 1;
        $exam->save();

        return Storage::download( $exam->path );
    }

    /**
     * Display the specified resource.
     *
     * @param $university
     * @param $association
     * @param $course
     * @param $exam
     * @return Factory|View
     */
    public function full( $university, $association, $course, $exam )
    {
        $exam = Exam::where(  'slug', $exam )->first();

        return view( 'exams.show' )->with( 'exam', $exam );
    }
}
