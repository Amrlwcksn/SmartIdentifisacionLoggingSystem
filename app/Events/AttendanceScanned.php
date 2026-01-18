<?php

namespace App\Events;

use App\Models\Attendance;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AttendanceScanned implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $attendance;

    public function __construct(Attendance $attendance)
    {
        // Load data siswa dan orang tua agar bisa ditampilkan di dashboard
        $this->attendance = $attendance->load('student.parent');
    }

    public function broadcastOn(): array
    {
        // kirim ke public channel agar mudah diakses dashboard
        return [
            new Channel('attendance-channel'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'attendance.scanned';
    }
}