<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = Exam::all()->count();
        $exams = Exam::orderBy('file_name', 'asc')->simplePaginate( 150 );
        
        return view( 'linda' )->with( 'total', $total )->with('exams', $exams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function download(Request $request)
    {   
        dd($request);
        return response()->download($path);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'exam' => 'required|mimetypes:application/pdf|max:50000'
        ]);
        
        

        if($request->exam){
            //Get filename with extension
            $fileNameWithExt = $request->exam->getClientOriginalName();
            //Get just filename
            
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('exam')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload file 
            $path = $request->file('exam')->storeAs('public/exams', $fileNameToStore);
        } else {
            return redirect('/linda')->with('danger', 'Exam failed');

        }

        $exam = new Exam;
        $exam->file_name = $fileNameToStore;
        $exam->course_id = 1;
        $exam->name = "boi";
        $exam->save();

        return redirect('/linda')->with('success', 'Exam uploaded');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        return Storage::url($exam);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
