<?php

namespace App\Http\Controllers;

use App\Course;
use App\Exam;
use App\University;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'verified' )->except( 'index', 'show', 'create' );
        $this->middleware( 'valid_user' )->except( 'index', 'show', 'create' );
        $this->middleware( 'moderator' )->except( 'index', 'show', 'create' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::all();

        return view( 'exams.index' )->with( 'exams', $exams );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate( [
            'name' => 'required|string',
            'grade' => 'required|string',
            'points' => 'required|integer',
            'exam' => 'required|mimetypes:application/pdf',
        ] );

        $course = Course::findOrFail( $request->course_id );

        $path = Storage::putFile(
            'exams/' . str_replace( ' ', '-', $course->code ), new File($request->exam)
        );

        Exam::create( [
            'name' => $request->name,
            'grade' => $request->grade,
            'points' => $request->points,
            'file_name' => $request->exam->getClientOriginalName(),
            'course_id' => $request->course_id,
            'path' => $path
        ] );

        return redirect()->route( 'exams.index' )->with( 'success', 'Ny tenta uppladdad! Yay.' );
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort( 404 );
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
        abort( 403 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Exam::findOrFail( $id );
        $this->authorize( 'delete', Auth::user(), $exam );

        $exam->delete();
        return redirect()->back()->with( 'success', 'Tenta borttagen, waow...' );
    }
}
