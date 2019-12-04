<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'course_id',
        'file_name',
        'name',
        'grade',
        'points',
        'path',
    ];

    public function course(){
        return $this->belongsTo('App\Course');
    }

    public static function updateAttributes( Request $request, $id )
    {
        Exam::validate( $request );
        $exam = Exam::findOrFail( $id );
        $exam->update( $request->except( '_token', '_method', 'recaptcha' ) );

        return $exam;
    }


    public static function validate( Request $request )
    {
        return $request->validate( [
            'name' => 'required|string',
            'grade' => 'required|string',
            'points' => 'required|numeric',
            'exam' => 'mimetypes:application/pdf',
            'recaptcha' => 'required',
        ] );
    }
}
