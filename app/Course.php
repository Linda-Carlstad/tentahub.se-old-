<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    public function association(){
        return $this->belongsTo('App\Association');
    }
    public function exams(){
        return $this->hasMany('App\Exam');
    }
}
