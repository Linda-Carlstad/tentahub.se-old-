<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function index(){
        return view('linda');
    }

    public function showUploadFile(Request $request){
        $file = $request->file('image');

        $destinationPath = '../storage/exams';
        $file->move($destinationPath,$file->getCLientOriginalName());

        return back()->with( 'success', 'Exam Uploaded!' );   
    }
}
