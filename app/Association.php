<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Association extends Model
{
    protected $table = 'associations';

    protected $fillable =
        [
            'name', 'nickname', 'university_id', 'description', 'url'
        ];

    public function university()
    {
        return $this->belongsTo( 'App\University' );
    }
    public function courses(){
        return $this->hasMany( 'App\Course' );
    }

    public function exams()
    {
        return $this->hasManyThrough( 'App\Exam', 'App\Course' );
    }

    public static function store( Request $request )
    {
        Association::validate( $request );
        $association = Association::create( $request->except( '_token' ) );

        return $association;
    }

    public static function updateAttributes( Request $request, $id )
    {
        Association::validate( $request );
        $association = Association::findOrFail( $id );
        $association->update( $request->except( '_token', '_method' ) );

        return $association;
    }

    public static function validate( Request $request )
    {
        $request->validate(
            [
                'name'          => 'required|string',
                'university_id' => 'required|integer',
                'url'           => 'string',
                'description'   => 'string'
            ] );
    }
}
