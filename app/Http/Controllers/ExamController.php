<?php

namespace App\Http\Controllers;

use App\Course;
use App\Exam;
use App\University;
use App\Verification;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'verified' )->except( 'index', 'show', 'create', 'store', 'download' );
        $this->middleware( 'valid_user' )->except( 'index', 'show', 'create', 'store', 'download'  );
        $this->middleware( 'moderator' )->except( 'index', 'show', 'create', 'store', 'download'  );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $exams = Exam::all();

        return view( 'exams.index' )->with( 'exams', $exams );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $universities = University::all();

        return view( 'exams.create' )->with( 'universities', $universities );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $result = Verification::run( $request, 'recapctha' );
        if( !$result )
        {
            return back()->with( 'error', 'Capatcha fel!' );
        }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::findOrFail( $id );

        return view( 'exams.show' )->with( 'exam', $exam );
    }

    public function view( $id )
    {
        $exam = Exam::findOrFail( $id );
        $exam->views += 1;
        $exam->save();

        return redirect( Storage::url( $exam->path ) );
    }

    public function download( $id )
    {
        $exam = Exam::findOrFail( $id );
        $exam->downloads += 1;
        $exam->save();

        return Storage::download( $exam->path );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $exam = Exam::findOrFail( $id );
        $universities = University::all();

        return view( 'exams.edit' )->with( 'exam', $exam )->with( 'universities', $universities );
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
        $exam = Exam::findOrFail( $id );
        $this->authorize( 'update', Auth::user(), $exam );

        $result = Exam::updateAttributes( $request, $id );

        if( $result[ 0 ] === 'success' )
        {
            return redirect()->route( 'exams.show', $exam->id )->with( $result[ 0 ], $result[ 1 ] );
        }

        return redirect()->back()->with( $result[ 0 ], $result[ 1 ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $exam = Exam::findOrFail( $id );
        $this->authorize( 'delete', Auth::user(), $exam );

        $exam->delete();
        return redirect()->back()->with( 'success', 'Tenta borttagen, waow...' );
    }
}
