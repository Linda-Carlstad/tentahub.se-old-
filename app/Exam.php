<?php

namespace App;

use App\Events\Exams\ExamDeleted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'course_id',
        'file_name',
        'name',
        'grade',
        'points',
        'path',
        'date',
        'type',
        'slug',
        'created_from',
        'changed_from'
    ];

    protected $dispatchesEvents = [
        'deleted' => ExamDeleted::class,
    ];

    public function course(){
        return $this->belongsTo('App\Course');
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

    public static function updateAttributes( Request $request, $id )
    {
        $result = Verification::run( $request, 'exam' );

        if( $result )
        {
            $exam = Exam::findOrFail( $id );
            $exam->update( $request->except( '_token', '_method', 'recaptcha', 'type', 'created_from' ) );

            return [ 'success', 'Ändring av uppgifterna lyckades, yippie!' ];
        }

        return [ 'error', 'Något gick fel när du ändrade uppgifterna, försök igen.' ];
    }

    public static function store( Request $request )
    {
        $course = Course::findOrFail( $request->course_id );
        $path = Exam::getStoragePath( $request, $course );
        $date = $request->date ? $request->date : date( 'Y-m-d' );

        Exam::create( [
            'name' => $request->name,
            'grade' => $request->grade,
            'points' => $request->points,
            'file_name' => $request->exam->getClientOriginalName(),
            'course_id' => $request->course_id,
            'path' => $path,
            'date' => $date,
            'type' => $request->type,
            'created_from' => $request->created_from,
        ] );

        return [ 'success', 'Ny tenta uppladdad! Yay.' ];
    }

    public static function automaticStore( Request $request )
    {
        $fileName = $request->exam->getClientOriginalName();

        // Splits the exam information from file type
        $temp = explode( '.', $fileName );
        $temp = explode( '-', $temp[ 0 ] );

        $courseCode = $temp[ 0 ];
        $year = $temp[ 1 ];
        $month = $temp[ 2 ];
        $day = $temp[ 3 ];

        $result = Exam::getCourse( $courseCode );
        if( $result[ 0 ] === 'error' )
        {
            return [ $result[ 0 ], $result[ 1 ] ];
        }

        $course = $result[ 2 ];
        $path = Exam::getStoragePath( $request, $course );
        $random = Exam::getRandomNumber();
        $date = $year . '-' . $month . '-' . $day . ' 00:00:00';

        Exam::create( [
            'name' => 'Tenta ' . $random,
            'file_name' => $fileName,
            'course_id' => $course->id,
            'path' => $path,
            'date' => $date,
            'type' => $request->type,
            'created_from' => $request->created_from,
        ] );

        return [ 'success', 'Tenta uppladdad, bra jobbat.' ];
    }

    public static function getCourse( $code )
    {
        $course = Course::where( 'code', $code )->first();

        if( $course )
        {
            return [ 'success', 'Ny tenta uppladdad! Du kan nu titta och ladda ner den.', $course ];
        }
        return [ 'error', 'Ingen kurs matchar tentan. Vänligen lägg till kursen eller kontakta en föreningsansvarig för att lägga till kursen.' ];
    }

    public static function getStoragePath( $request, $course ) {
        $temp = Exam::getRandomNumber();
        $association = Association::findOrFail( $course->association_id );
        $university = University::findOrFail( $association->university_id );

        $exam = Storage::putFileAs(
            'exams/' . $university->slug . '/' . $association->slug . '/' . $course->code,
            new File( $request->exam ), $request->exam->getClientOriginalName() . '-' .  $temp
        );

        return $exam;
    }

    public static function getRandomNumber()
    {
        $now = time(); // or your date as well
        $your_date = strtotime("2010-01-31");
        $random = $now - $your_date;
        $length = 4;

        return substr( round( $random ), -$length, $length );
    }
}
