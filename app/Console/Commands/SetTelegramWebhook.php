<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SetTelegramWebhook extends Command
{
    protected $signature = 'telegram:set-webhook {url}';
    protected $description = 'Set the Telegram Bot Webhook URL';

    public function handle()
    {
        $token = config('services.telegram.bot_token');
        $url = $this->argument('url');

        if (empty($token)) {
            $this->error('TELEGRAM_BOT_TOKEN belum diatur!');
            return;
        }

        $webhookUrl = $url . '/api/telegram/webhook';
        $this->info("Mengatur Webhook ke: $webhookUrl");

        $response = Http::get("https://api.telegram.org/bot{$token}/setWebhook", [
            'url' => $webhookUrl
        ]);

        if ($response->successful()) {
            $this->info('Webhook Berhasil diatur!');
            $this->line('Respon: ' . $response->body());
        } else {
            $this->error('Gagal mengatur Webhook.');
            $this->line('Error: ' . $response->body());
        }
    }
}
