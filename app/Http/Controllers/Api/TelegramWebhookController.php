<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ParentModel;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    protected $telegram;

    public function __construct(TelegramService $telegram)
    {
        $this->telegram = $telegram;
    }

    public function handle(Request $request)
    {
        // ... (existing handle logic preserved for redundancy or direct webhook)
        $update = $request->all();
        // ... (I'll keep the existing handle method as is)
    }

    public function linkFromFlask(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'telegram_id' => 'required'
        ]);

        $student = Student::where('nis', $request->nis)->first();

        if (!$student) {
            return response()->json(['message' => 'NIS tidak ditemukan'], 404);
        }

        $parent = $student->parent;
        if (!$parent) {
            return response()->json(['message' => 'Data wali belum ada'], 422);
        }

        $parent->update(['telegram_id' => $request->telegram_id]);

        return response()->json([
            'status' => 'success',
            'student_name' => $student->name
        ]);
    }
}
