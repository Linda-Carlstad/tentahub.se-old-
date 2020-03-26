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
            ->usingSeparator( '-' )
            ->usingLanguage( 'sv' );
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
        $result = Verification::run( $request, 'association' );
        if( $result )
        {
            $association = Association::create( $request->except( '_token' ) );
            return [ 'success', 'Ny förening tillagd, va nice!', $association];
        }
        return [ 'error', 'Något gick fel i maskineriet, testa igen!' ];
    }

    public static function updateAttributes( Request $request, Association $association )
    {
        $result = Verification::run( $request, 'association' );
        if( $result )
        {
            $association->update( $request->except( '_token', '_method' ) );
            return [ 'success', 'Ändring av uppgifterna lyckades, yippie!', $association];
        }
        return [ 'error', 'Något gick fel i maskineriet, testa igen!' ];
    }
}
