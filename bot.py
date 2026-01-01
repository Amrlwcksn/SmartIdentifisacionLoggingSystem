from flask import Flask, request, jsonify
import requests
import os
from dotenv import load_dotenv

# Load .env file
load_dotenv()

app = Flask(__name__)

# --- KONFIGURASI ---
TELEGRAM_TOKEN = os.getenv("TELEGRAM_TOKEN", "your toke")
LARAVEL_API_URL = os.getenv("LARAVEL_API_URL", "http://localhost:8000/api/internal/link-telegram")
BOT_URL = f"https://api.telegram.org/bot{TELEGRAM_TOKEN}/"

def send_message(chat_id, text):
    url = BOT_URL + "sendMessage"
    payload = {
        "chat_id": chat_id,
        "text": text,
        "parse_mode": "HTML"
    }
    try:
        response = requests.post(url, json=payload)
        return response.json()
    except Exception as e:
        print(f"Error sending message: {e}")
        return None

@app.route('/webhook', methods=['POST'])
def webhook():
    update = request.get_json()
    
    if "message" in update:
        message = update["message"]
        chat_id = message["chat"]["id"]
        text = message.get("text", "").strip()

        if text == "/start":
            welcome_msg = (
                "👋 <b>Selamat datang di SILS Notifikasi!</b>\n\n"
                "Silakan masukkan <b>NIS</b> (Nomor Induk Siswa) putra/putri Anda "
                "untuk mengaktifkan notifikasi kehadiran otomatis."
            )
            send_message(chat_id, welcome_msg)
        
        elif text.isdigit():
            # Kirim data ke Laravel untuk verifikasi dan linking
            try:
                response = requests.post(LARAVEL_API_URL, json={
                    "nis": text,
                    "telegram_id": chat_id
                })
                
                if response.status_code == 200:
                    data = response.json()
                    success_msg = (
                        "✅ <b>Berhasil Terhubung!</b>\n\n"
                        f"Akun Anda kini tertaut dengan: <b>{data['student_name']}</b>.\n\n"
                        "Anda akan menerima notifikasi setiap kali siswa melakukan presensi."
                    )
                    send_message(chat_id, success_msg)
                else:
                    error_msg = "❌ <b>Gagal!</b>\nNIS tidak ditemukan. Mohon periksa kembali nomor NIS Anda."
                    send_message(chat_id, error_msg)
            except Exception as e:
                print(f"Laravel Connection Error: {e}")
                send_message(chat_id, "⚠️ <b>Sistem Sedang Sibuk</b>\nMohon coba beberapa saat lagi.")
        
        else:
            send_message(chat_id, "❓ Mohon masukkan <b>NIS</b> siswa (berupa angka) untuk menautkan akun.")

    return jsonify({"status": "ok"})

if __name__ == '__main__':
    print("SILS Telegram Bot (Flask) is running...")
    app.run(port=5000, debug=True)
