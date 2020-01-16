<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class University extends Model
{
    protected $table = 'universities';

    protected $fillable =
    [
        'name',
        'nickname',
        'city',
        'country',
        'description',
        'url',
        'slug'
    ];


    public function associations()
    {
        return $this->hasMany( 'App\Association' );
    }

    public function courses()
    {
        return $this->hasManyThrough( 'App\Course', 'App\Association' );
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
        $result = Verification::run( $request, 'university' );
        if( $result )
        {
            $university = University::create( $request->except( '_token' ) );
            return [ 'success', 'Nytt universitet tillagt, bra jobbat!', $university ];
        }
        return [ 'error', 'Något gick fel i maskineriet, testa igen!' ];
    }

    public static function updateAttributes( Request $request, University $university )
    {
        $result = Verification::run( $request, 'university' );
        if( $result )
        {
            $university->update( $request->except( '_token', '_method' ) );
            return [ 'success', 'Ändring av uppgifterna lyckades, yay!' ];
        }

        return [ 'error', 'Något gick fel i maskineriet, testa igen!' ];
    }
}
