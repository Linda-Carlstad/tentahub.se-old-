<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class University extends Model
{
    protected $table = 'universities';

    protected $fillable =
    [
        'name', 'nickname', 'city', 'country', 'description'
    ];


    public function associations()
    {
        return $this->hasMany( 'App\Association' );
    }

    public function courses()
    {
        return $this->hasManyThrough( 'App\Course', 'App\Association' );
    }

    public static function store( Request $request )
    {
        University::validate( $request );
        $university = University::create( $request->except( '_token' ) );

        return $university;
    }

    public static function updateAttributes( Request $request, $id )
    {
        University::validate( $request );
        $university = University::findOrFail( $id );
        $university->update( $request->except( '_token' ) );

        return $university;
    }

    public static function validate( Request $request )
    {
        $request->validate(
        [
            'name'        => 'required|string',
            'nickname'    => 'required|string|max:20',
            'city'        => 'required|string',
            'country'     => 'required|string',
            'description' => 'string',
        ] );
    }
}
