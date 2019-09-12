<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'universities';

    public function associations(){
        return $this->hasMany('App\Association');
    }
}
