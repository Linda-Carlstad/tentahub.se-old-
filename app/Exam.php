<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'course_id',
        'file_name',
        'name',
        'grade',
        'points',
        'path'
    ];

    public function course(){
        return $this->belongsTo('App\Course');
    }
}
