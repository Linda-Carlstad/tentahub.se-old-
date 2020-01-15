<?php

namespace App\Events\Exams;

use App\Exam;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExamDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $exam;

    /**
     * Create a new event instance.
     *
     * @param Exam $exam
     */
    public function __construct( Exam $exam )
    {
        $this->exam = $exam;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
