<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    protected $table = 'associations';

    public function university(){
        return $this->belongsTo('App\University');
    }
    public function courses(){
        return $this->hasMany('App\Course');
    }

    public function exams(){
        return $this->hasManyThrough( 'App\Exam', 'App\Course' );
    }
}
