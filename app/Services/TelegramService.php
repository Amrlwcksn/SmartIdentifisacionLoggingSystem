<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected $token;
    protected $baseUrl;

    public function __construct()
    {
        $this->token = config('services.telegram.bot_token');
        $this->baseUrl = "https://api.telegram.org/bot{$this->token}/";
    }

    public function sendMessage($chatId, $message)
    {
        if (empty($this->token) || empty($chatId)) {
            Log::warning("Telegram Notification skipped: Token or ChatID missing.");
            return false;
        }

        try {
            $response = Http::post($this->baseUrl . 'sendMessage', [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML'
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error("Telegram Error: " . $e->getMessage());
            return false;
        }
    }
}
