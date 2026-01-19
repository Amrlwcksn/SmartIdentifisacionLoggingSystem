# 🛡️ Smart Identifications Logging System (SILS)

**SILS** adalah sistem manajemen kehadiran siswa berbasis RFID yang modern, cepat, dan terintegrasi secara langsung dengan notifikasi Telegram. Sistem ini dirancang untuk memberikan kemudahan bagi sekolah dalam memantau kehadiran siswa secara real-time.

---

## Fitur Utama
- **Monitor Live Dashboard**: Pantau kehadiran siswa secara real-time tanpa refresh.
- **Manajemen Data Siswa & Wali**: Pengelolaan data lengkap dengan sistem pencarian dan pagination.
- **Notifikasi Telegram**: Pengiriman notifikasi kehadiran otomatis ke orang tua/wali murid via Bot Telegram.
- **Rekap & Laporan**: Filter riwayat kehadiran dan export laporan dalam format CSV (Excel-friendly).
- **Dual Theme Support**: Mendukung Mode Terang (Light) dan Gelap (Dark) untuk kenyamanan visual.

---

## Prasyarat (Requirements)
Sebelum memulai, pastikan perangkat Anda sudah terinstal:
- **PHP** >= 8.2
- **Composer** (Dependency Manager untuk PHP)
- **Node.js & NPM** (Untuk pengelolaan aset frontend)
- **MySQL** atau MariaDB (Database)
- **Python 3.x** (Untuk menjalankan Bot Telegram)

---

## Panduan Instalasi (Step-by-Step)

### 1. Clone Repositori
```bash
git clone https://github.com/Amrlwcksn/SmartIdentifisacionLoggingSystem.git
cd SmartIdentifisacionLoggingSystem/SILS
```

### 2. Instal Dependency
Instal library PHP:
```bash
composer install
```
Instal library Frontend:
```bash
npm install
```
Instal library Python untuk Bot:
```bash
pip install -r requirements.txt
```

### 3. Konfigurasi Environment
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```

Buka file `.env` dan sesuaikan pengaturan berikut:

#### A. Database Configuration
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=silsv1
DB_USERNAME=root
DB_PASSWORD=your_password
```

#### B. Reverb WebSocket Configuration
Reverb sudah terinstall secara default. Anda bisa menggunakan credentials yang sudah ada di `.env.example`, atau generate yang baru:
```bash
php artisan reverb:install
```

Pastikan konfigurasi berikut ada di `.env`:
```env
BROADCAST_CONNECTION=reverb

REVERB_APP_ID=690272
REVERB_APP_KEY=kquuyyute3nals1aab9i
REVERB_APP_SECRET=ywki3camcn45eet6y48g
REVERB_HOST="localhost"
REVERB_PORT=8080
REVERB_SCHEME=http

VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"
```

#### C. Telegram Bot Configuration
1. Buka Telegram dan cari **@BotFather**
2. Kirim perintah `/newbot` dan ikuti instruksi
3. Salin **token** yang diberikan (format: `1234567890:ABCdefGHIjklMNOpqrsTUVwxyz`)
4. Masukkan token ke `.env`:
```env
TELEGRAM_TOKEN=1234567890:ABCdefGHIjklMNOpqrsTUVwxyz
LARAVEL_API_URL=http://localhost:8000/api/internal/link-telegram
```

> **Catatan**: Jika deploy ke server, ganti `localhost:8000` dengan URL server Anda.

### 4. Generate Application Key & Link Storage
```bash
php artisan key:generate
php artisan storage:link
```

### 5. Migrasi & Seed Database
Buat database di MySQL sesuai dengan nama di `.env`, lalu jalankan:
```bash
php artisan migrate --seed
```

---

## Cara Menjalankan Project

Sistem ini membutuhkan **4 terminal** yang berjalan bersamaan:

### Terminal 1: Laravel Backend
```bash
php artisan serve --host=0.0.0.0
```
> **Penting**: Gunakan `0.0.0.0` agar ESP32 (IoT) bisa terhubung ke server.

### Terminal 2: Reverb WebSocket Server
```bash
php artisan reverb:start
```
> **Fungsi**: Membuat dashboard update otomatis tanpa refresh saat ada presensi.

### Terminal 3: Vite Asset Compiler
```bash
npm run dev
```
> **Fungsi**: Compile CSS/JS dan hot-reload untuk development.

### Terminal 4: Telegram Bot (Python)
```bash
python bot.py
```
> **Fungsi**: Menjalankan webhook server untuk menerima pesan dari Telegram.

### Terminal 5 (Opsional): Tunneling untuk Webhook
Jika development di localhost, gunakan tunneling untuk webhook Telegram:
```bash
npx localtunnel --port 5000
```

Salin URL yang muncul (contoh: `https://abcd.loca.lt`), lalu set webhook:
```text
https://api.telegram.org/bot<YOUR_BOT_TOKEN>/setWebhook?url=<TUNNEL_URL>/webhook
```

**Contoh**:
```text
https://api.telegram.org/bot1234567890:ABCdefGHIjklMNOpqrsTUVwxyz/setWebhook?url=https://abcd.loca.lt/webhook
```

---

## Modul Hardware (IoT RFID)
SILS menggunakan perangkat keras berbasis **ESP32** untuk melakukan pemindaian kartu. Pastikan Anda juga menyiapkan repositori hardware berikut:

- **Repositori IoT**: [IoT_SmartIdentificationLoggingSystem_RFID](https://github.com/Amrlwcksn/IoT_SmartIdentificationLoggingSystem_RFID)

---

## Troubleshooting

### WebSocket / Real-time Tidak Berfungsi

**Gejala**: Dashboard tidak update otomatis saat ada presensi baru.

**Solusi**:
1. **Pastikan Reverb server berjalan**:
   ```bash
   php artisan reverb:start
   ```
   Harus muncul output: `Reverb server started on 127.0.0.1:8080`

2. **Cek konfigurasi `.env`**:
   ```env
   BROADCAST_CONNECTION=reverb  # Bukan 'log' atau 'null'
   ```

3. **Cek browser console** (F12):
   - Jika ada error `WebSocket connection failed`, pastikan port 8080 tidak digunakan aplikasi lain
   - Restart Reverb server: `Ctrl+C` lalu `php artisan reverb:start`

4. **Clear cache dan restart Vite**:
   ```bash
   php artisan config:clear
   npm run dev
   ```

### Telegram Bot Tidak Mengirim Pesan

**Gejala**: Notifikasi tidak sampai ke Telegram user.

**Solusi**:
1. **Pastikan bot.py berjalan**:
   ```bash
   python bot.py
   ```
   Harus muncul: `SILS Telegram Bot (Flask) is running...`

2. **Cek TELEGRAM_TOKEN di `.env`**:
   - Token harus valid dari @BotFather
   - Format: `1234567890:ABCdefGHIjklMNOpqrsTUVwxyz`

3. **Cek webhook sudah di-set**:
   - Buka browser, akses:
     ```text
     https://api.telegram.org/bot<TOKEN>/getWebhookInfo
     ```
   - Pastikan `url` tidak kosong dan mengarah ke server bot Anda

4. **Test koneksi Laravel API**:
   - Pastikan `LARAVEL_API_URL` di `.env` benar
   - Test manual: `curl http://localhost:8000/api/internal/link-telegram`

5. **Jika development di localhost**:
   - Wajib gunakan tunneling (localtunnel/ngrok)
   - Set webhook setiap kali URL tunnel berubah

### Database Connection Error

**Gejala**: Error `SQLSTATE[HY000] [2002] Connection refused`

**Solusi**:
1. **Pastikan MySQL server berjalan**:
   - Windows (XAMPP): Start MySQL di XAMPP Control Panel
   - Linux: `sudo systemctl start mysql`

2. **Cek kredensial database di `.env`**:
   ```env
   DB_DATABASE=silsv1  # Database harus sudah dibuat
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

3. **Buat database jika belum ada**:
   ```sql
   CREATE DATABASE silsv1;
   ```

4. **Clear config cache**:
   ```bash
   php artisan config:clear
   ```

###  CORS Error pada WebSocket

**Gejala**: Browser console menampilkan CORS error saat connect ke WebSocket.

**Solusi**:
1. **Update `config/cors.php`** (jika perlu):
   ```php
   'allowed_origins' => ['*'],
   ```

2. **Pastikan Reverb menggunakan scheme yang benar**:
   - Development: `REVERB_SCHEME=http`
   - Production (HTTPS): `REVERB_SCHEME=https`

---

## Checklist Sebelum Testing

- [ ] MySQL server berjalan
- [ ] Database `silsv1` sudah dibuat
- [ ] File `.env` sudah dikonfigurasi dengan benar
- [ ] `php artisan migrate --seed` berhasil dijalankan
- [ ] Terminal 1: `php artisan serve` berjalan
- [ ] Terminal 2: `php artisan reverb:start` berjalan
- [ ] Terminal 3: `npm run dev` berjalan
- [ ] Terminal 4: `python bot.py` berjalan
- [ ] Telegram webhook sudah di-set (jika menggunakan bot)
- [ ] Browser bisa akses `http://localhost:8000`

---

## Lisensi

Proyek ini tersedia secara gratis untuk kebutuhan **edukasi** dan **personal**. Namun, jika Anda ingin menggunakan proyek ini untuk kebutuhan **komersial**, Anda **wajib** melakukan konfirmasi dan mendapatkan izin terlebih dahulu dari pengembang.

Lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.

---

## ontak & Kerjasama
Jika ada pertanyaan, butuh bantuan, atau ingin berdiskusi mengenai penggunaan komersial, silakan hubungi saya melalui:

- **GitHub**: [@Amrlwcksn](https://github.com/Amrlwcksn)
- **Instagram**: [@amirulwicaksono_](https://instagram.com/amirulwicaksono_)
- **Email**: amrlwcksn@gmail.com
