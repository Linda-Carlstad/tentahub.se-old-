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
            'description' => 'nullable|string',
            'url'         => 'nullable|string'
        ] );
    }
}
