<?php

namespace App\Events\Courses;

use App\Association;
use App\Events\Courses\CourseCreated;
use App\University;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class AddCourseDirectoryToStorage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CourseCreated  $event
     * @return void
     */
    public function handle(CourseCreated $event)
    {
        $course = $event->course;

        $association = Association::findOrFail( $course->association_id );
        $university = University::findOrFail( $association->university_id );

        Storage::makeDirectory( 'exams/' . $university->slug . '/' . $association->slug . '/' . $course->code );
    }
}
