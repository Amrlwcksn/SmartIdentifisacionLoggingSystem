# 🚀 Panduan Menjalankan Sistem SILS

Ikuti urutan langkah di bawah ini untuk menjalankan seluruh ekosistem SILS (Laravel + Flask + Real-time + Telegram).

---

### 1. Jalankan Backend (Laravel)
Buka Terminal 1:
```bash
php artisan serve --host=0.0.0.0
```
> [!NOTE]
> Alamat `0.0.0.0` wajib digunakan agar perangkat IoT (ESP32) bisa terhubung ke laptop Anda.

### 2. Jalankan Real-time Server (Reverb)
Buka Terminal 2:
```bash
php artisan reverb:start
```
> [!TIP]
> Ini yang membuat dashboard bisa update otomatis tanpa refresh saat ada kartu yang di-tap.

### 3. Jalankan Kompilasi Aset (Vite)
Buka Terminal 3:
```bash
npm run dev
```

### 4. Jalankan Bot Telegram (Python Flask)
Buka Terminal 4:
```bash
python bot.py
```
> [!IMPORTANT]
> Pastikan Anda sudah menginstal library yang dibutuhkan: `pip install -r requirements.txt`.

### 5. Jalankan Tunneling (Localtunnel)
Buka Terminal 5:
```bash
npx localtunnel --port 5000
```
> [!WARNING]
> Copy URL yang muncul (misal: `https://abcd.loca.lt`). Karena URL ini berubah setiap kali dijalankan, Anda perlu mengupdate Webhook Telegram.

### 6. Set Webhook Telegram (Penting!)
Buka browser dan jalankan URL berikut (Ganti dengan Token dan URL Localtunnel Anda):
```text
https://api.telegram.org/bot8052822195:AAFlzdoQ4l_8aK7OkwxPA6aHRVyNo7q4YOY/setWebhook?url=https://URL-DARI-LOCALTUNNEL/webhook
```

---

## 📱 Alur Pengujian
1. **Daftarkan Wali**: Masukkan data nama dan nomor HP wali.
2. **Daftarkan Siswa**: Masukkan NIS dan hubungkan dengan wali yang tadi dibuat.
3. **Link Telegram**: Klik tombol Start di @SILS_Notification_Bot lalu masukkan NIS siswa.
4. **Tap Kartu**: Lakukan simulasi tap kartu (atau input manual), maka notifikasi akan masuk ke Telegram dan Dashboard secara live!
