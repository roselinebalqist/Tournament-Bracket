# Tournament Bracket

Sistem Manajemen Turnamen dan Bracket Otomatis berbasis Laravel yang digunakan untuk mengelola turnamen, peserta, pertandingan, serta menghasilkan bracket pertandingan secara otomatis.

## Fitur Utama

* Autentikasi pengguna (Login & Register)
* Manajemen Turnamen (CRUD)
* Manajemen Peserta
* Pembuatan Bracket Otomatis
* Penjadwalan Pertandingan
* Input Hasil Pertandingan
* Penentuan Pemenang Otomatis
* Dashboard Admin

## Teknologi yang Digunakan

* Laravel 12
* PHP 8.2+
* MySQL
* Bootstrap / Tailwind CSS
* JavaScript

## Instalasi

### Clone Repository

```bash
git clone https://github.com/roselinebalqist/Tournament-Bracket.git
cd Tournament-Bracket
```

### Install Dependency

```bash
composer install
npm install
```

### Konfigurasi Environment

Salin file `.env.example` menjadi `.env`

```bash
copy .env.example .env
```

Kemudian sesuaikan konfigurasi database pada file `.env`.

### Generate Application Key

```bash
php artisan key:generate
```

### Migrasi Database

```bash
php artisan migrate
```

### Menjalankan Aplikasi

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```
http://127.0.0.1:8000
```

## Struktur Fitur

* User Authentication
* Tournament Management
* Team/Participant Management
* Match Scheduling
* Automatic Bracket Generation
* Match Result Management
* Winner Determination

## Pengembang

**Roseline Balqist**
Program Studi Informatika
Universitas Syiah Kuala

## License

Project ini dibuat untuk keperluan pembelajaran dan tugas mata kuliah Pemrograman Berbasis Web.
