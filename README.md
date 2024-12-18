# KAHOOT FIK FAIR
## Project Cloning Kahoot HMTI UDINUS

HMTI dengan bangga mempersembahkan website cloning Kahoot untuk keperluan FIK FAIR. Website ini dibuat atas dedikasi, kerjasama, dan kerja keras teman-teman developer dari HMTI UDINUS.

## 🚀 Technology Stack
- **Laravel** - Framework PHP Utama
- **MySQL** - Database Relasional
- **Filament** - Library Dashboard Admin
- **Livewire** - Framework Frontend Interaktif

## 👥 Developer Tim
1. Ivan Putra Pratama 
2. Primavieri Rhesa Ardana 
3. Sahrul Amri
4. Haydar Hilmy Alhakim
5. Mustafid Kaisalana 

## 🛠 Prasyarat Sistem
- PHP 8.0
- Composer
- Node.js & NPM
- MySQL 5.7+

## 📦 Instalasi Proyek

### Langkah 1: Clone Repositori
```bash
git clone https://github.com/LibraTechDev/Clone-Kahoot
cd kahoot-clone
```

### Langkah 2: Instalasi Dependensi
```bash
# Install dependensi PHP
composer install

# Install dependensi Node.js
npm install && npm run build
```

### Langkah 3: Konfigurasi Environment
```bash
# Salin file environment
cp .env.example .env

# Generate key aplikasi Laravel
php artisan key:generate
```

### Langkah 4: Konfigurasi Database
Edit file `.env` dengan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kahoot_clone
DB_USERNAME=root
DB_PASSWORD=
```

### Langkah 5: Migrasi Database
```bash
# Jalankan migrasi database
php artisan migrate

# Opsional: Isi data awal
php artisan db:seed
```

### Langkah 6: Jalankan Aplikasi
```bash
# Jalankan server Laravel
php artisan serve

# Untuk development, gunakan Vite
npm run dev
```

## ✨ Fitur Utama
- 📝 Pembuatan kuis interaktif
- 🎮 Main kuis real-time
- 📊 Sistem penilaian otomatis
- 🖥️ Manajemen kuis via dashboard admin Filament


## 📞 Kontak
- **Himpunan Mahasiswa Teknik Informatika (HMTI) UDINUS**
- **Email**: hmti@ormadinus.ac.id
- **Website**: https://hmtiudinus.org

**Dibuat dengan ❤️ oleh Tim Developer HMTI UDINUS**

## 🔧 Troubleshooting
Jika mengalami masalah:
- Pastikan semua prasyarat terpenuhi
- Periksa versi PHP dan ekstensi
- Cek koneksi database
- Jalankan `composer update` dan `npm update`

## 📡 Integrasi Tambahan
- Filament Admin Panel
- Livewire untuk interaksi real-time

