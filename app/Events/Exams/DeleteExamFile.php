<?php

namespace App\Events\Exams;

use App\Events\Exams\ExamDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class DeleteExamFile
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
     * @param  ExamDeleted  $event
     * @return void
     */
    public function handle(ExamDeleted $event)
    {
        $exam = $event->exam;
        Storage::delete( $exam->path );
    }
}
