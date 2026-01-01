# 🛡️ Smart Identifications Logging System (SILS)

**SILS** adalah sistem manajemen kehadiran siswa berbasis RFID yang modern, cepat, dan terintegrasi secara langsung dengan notifikasi Telegram. Sistem ini dirancang untuk memberikan kemudahan bagi sekolah dalam memantau kehadiran siswa secara real-time.

---

## ✨ Fitur Utama
- **Monitor Live Dashboard**: Pantau kehadiran siswa secara real-time tanpa refresh.
- **Manajemen Data Siswa & Wali**: Pengelolaan data lengkap dengan sistem pencarian dan pagination.
- **Notifikasi Telegram**: Pengiriman notifikasi kehadiran otomatis ke orang tua/wali murid via Bot Telegram.
- **Rekap & Laporan**: Filter riwayat kehadiran dan export laporan dalam format CSV (Excel-friendly).
- **Dual Theme Support**: Mendukung Mode Terang (Light) dan Gelap (Dark) untuk kenyamanan visual.

---

## 🛠️ Prasyarat (Requirements)
Sebelum memulai, pastikan perangkat Anda sudah terinstal:
- **PHP** >= 8.2
- **Composer** (Dependency Manager untuk PHP)
- **Node.js & NPM** (Untuk pengelolaan aset frontend)
- **MySQL** atau MariaDB (Database)
- **Python 3.x** (Untuk menjalankan Bot Telegram)

---

## 🚀 Panduan Instalasi (Step-by-Step)

### 1. Clone Repositori
```bash
git clone https://github.com/username/sils.git
cd sils
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
pip install flask requests
```

### 3. Konfigurasi Environment
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan pengaturan database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_db_anda
DB_PASSWORD=password_db_anda
```

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

## ⚙️ Cara Menjalankan Project
Sistem ini membutuhkan beberapa terminal yang berjalan bersamaan:

1. **Jalankan Laravel (Backend):**
   ```bash
   php artisan serve --host=0.0.0.0
   ```
2. **Jalankan Reverb (Real-time Server):**
   ```bash
   php artisan reverb:start
   ```
3. **Jalankan Vite (Kompilasi Aset):**
   ```bash
   npm run dev
   ```
4. **Jalankan Bot Telegram (Python):**
   ```bash
   python bot.py
   ```

---

## 🤖 Setup Bot Telegram (Webhook)
Agar notifikasi dan fitur integrasi NIS berhasil, Anda perlu mengatur Webhook:

1. Jalankan tunneling (misal menggunakan LocalTunnel atau Ngrok) ke port 5000:
   ```bash
   npx localtunnel --port 5000
   ```
2. Salin URL yang muncul (misal: `https://abcd.loca.lt`).
3. Set Webhook dengan mengakses URL berikut di browser (Ganti TOKEN dan URL):
   ```text
   https://api.telegram.org/bot<YOUR_BOT_TOKEN>/setWebhook?url=<LT_URL>/webhook
   ```

---

## 📝 Lisensi
Proyek ini bersifat open-source dan dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).
