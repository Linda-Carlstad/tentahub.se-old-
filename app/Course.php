<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable =
    [
        'name', 'code', 'description', 'points', 'url', 'association_id'
    ];


    public function association(){
        return $this->belongsTo('App\Association');
    }
    public function exams(){
        return $this->hasMany('App\Exam');
    }

    public static function store( Request $request )
    {
        Course::validate( $request );
        $course = Course::create( $request->except( '_token' ) );

        return $course;
    }

    public static function updateAttributes( Request $request, $id )
    {
        Course::validate( $request );
        $course = Course::findOrFail( $id );
        $course->update( $request->except( '_token', '_method' ) );

        return $course;
    }

    public static function validate( Request $request )
    {
        $request->validate(
        [
            'name'           => 'required|string',
            'code'           => 'required|string',
            'association_id' => 'required|integer',
            'url'            => 'string',
            'description'    => 'string',
            'points'         => 'required|numeric',
        ] );
    }
}
