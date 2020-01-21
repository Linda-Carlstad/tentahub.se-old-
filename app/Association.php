<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Association extends Model
{
    protected $table = 'associations';

    protected $fillable =
    [
        'name',
        'nickname',
        'university_id',
        'description',
        'url',
        'slug'
    ];

    public function users()
    {
        return $this->hasMany( 'App\User' );
    }

    public function university()
    {
        return $this->belongsTo( 'App\University' );
    }

    public function courses()
    {
        return $this->hasMany( 'App\Course' );
    }

    public function exams()
    {
        return $this->hasManyThrough( 'App\Exam', 'App\Course' );
    }

    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingSeparator( '-' );
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
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
            'url'           => 'nullable|string',
            'description'   => 'nullable|string'
        ] );
    }
}
