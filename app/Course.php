<?php

namespace App;

use App\Events\Courses\CourseCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable =
    [
        'name',
        'code',
        'description',
        'points',
        'url',
        'association_id',
        'slug'
    ];


    protected $dispatchesEvents = [
        'created' => CourseCreated::class,
    ];

    public function association(){
        return $this->belongsTo('App\Association');
    }

    public function exams(){
        return $this->hasMany('App\Exam');
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
        $result = Course::validate( $request );
        if( $result )
        {
            $course = Course::create( $request->except( '_token' ) );
            return [ 'success', 'Ny kurs tillagd, bra jobbat!', $course ];
        }

        return [ 'error', 'Något gick fel i maskineriet, testa igen!' ];
    }

    public static function updateAttributes( Request $request, $id )
    {
        $result = Course::validate( $request );
        if( $result )
        {
            $course = Course::findOrFail( $id );
            $course->update( $request->except( '_token', '_method' ) );
            return [ 'success', 'Ändring av uppgifterna lyckades, yay!', $course ];
        }

        return [ 'error', 'Något gick fel i maskineriet, testa igen!' ];
    }

    public static function validate( Request $request )
    {
        return $request->validate( [
            'name'           => 'required|string',
            'code'           => 'required|string|unique:courses,code,' . $request->course_code,
            'association_id' => 'required|integer',
            'url'            => 'nullable|string',
            'description'    => 'nullable|string',
            'points'         => 'required|numeric',
        ] );
    }
}
