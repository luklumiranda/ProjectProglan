# Website Hotel Paradise

Website booking hotel sederhana yang dibuat dengan PHP dan MySQL.

## Apa aja yang ada di sini?

- Login dan daftar akun
- Lihat halaman hotel dengan pilihan kamar
- Booking kamar hotel
- Dashboard user

## Yang perlu disiapkan

- XAMPP (buat jalanin PHP dan MySQL)
- Browser (Chrome, Firefox, atau apapun)
- Text editor kalau mau edit kode (VS Code, Notepad++, dll)

## Cara install

### 1. Install XAMPP

Download XAMPP dari website resminya, terus install. Gampang kok, tinggal next-next doang.

### 2. Setup database

- Buka XAMPP Control Panel
- Klik Start di Apache sama MySQL
- Buka browser, ketik `localhost/phpmyadmin`
- Bikin database baru namanya `user_login_system`
- Klik database yang baru dibuat
- Pilih tab SQL
- Copy semua isi file `database.sql` yang ada di folder ini
- Paste ke kotak SQL, terus klik Go

### 3. Taruh file website

Copy semua file PHP dari folder ini ke:
```
C:\xampp\htdocs\ProjectProglan\
```

Atau kalau mau nama folder lain juga boleh, terserah.

### 4. Buka websitenya

Buka browser, ketik:
```
http://localhost/ProjectProglan/login.php
```

Selesai! Website udah bisa dipake.

## Akun untuk testing

Kalau udah import database, bisa langsung login pake:
- Username: `admin`
- Password: `password123`

Atau bisa juga daftar akun baru.

## Struktur file

```
ProjectProglan/
├── config.php                 # Setting database
├── database.sql              # File SQL buat database
├── login.php                 # Halaman login
├── login_process.php         # Proses login
├── register.php              # Halaman daftar
├── register_process.php      # Proses daftar
├── home.php                  # Homepage hotel
├── booking.php               # Halaman booking
├── booking_process.php       # Proses booking
├── booking_success.php       # Konfirmasi booking berhasil
├── dashboard.php             # Dashboard user
└── logout.php                # Logout
```

## Fitur website

### Halaman login & register
- Login pake email atau username
- Daftar akun baru
- Ada validasi password minimal 8 karakter
- Password otomatis di-enkripsi

### Homepage hotel
- Info tentang hotel
- Fasilitas hotel (kolam renang, gym, spa, dll)
- 3 pilihan kamar:
  - Standard Room - 500rb/malam
  - Deluxe Room - 850rb/malam
  - Suite Room - 1.5jt/malam

### Booking
- Pilih tanggal check-in dan check-out
- Pilih jumlah tamu
- Bisa kasih catatan khusus
- Otomatis hitung total harga
- Dapat kode booking

## Kalo ada masalah

### Website gak kebuka / Not Found
- Cek Apache di XAMPP udah di-start belum
- Pastiin file ada di folder `htdocs`
- Cek lagi URL-nya, pastiin bener

### Error database / MySQL
- Cek MySQL di XAMPP udah jalan belum
- Pastiin database `user_login_system` udah dibuat
- Coba import ulang file `database.sql`

### Halaman blank
- Buka file `C:\xampp\apache\logs\error.log` buat liat error-nya apa
- Biasanya gara-gara ada typo di kode

## Mau edit konfigurasi database?

Buka file `config.php`, terus ubah bagian ini sesuai settingan MySQL kamu:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'user_login_system');
```

Biasanya sih gak perlu diubah kalo pake XAMPP default.

## Catatan penting

- Password user otomatis di-encrypt, jadi aman
- Jangan lupa backup database secara berkala
- Kalo mau dipake beneran (production), perlu setup SSL/HTTPS
- Ini masih versi sederhana, jadi belum ada payment gateway atau email notifikasi

## Database

Tabel `users` isinya:
- id
- first_name
- last_name  
- username
- email
- password (udah di-hash)
- created_at
- updated_at
- last_login
- status

Booking masih disimpen di session, belum masuk database. Kalo mau lebih lengkap, bisa tambahin tabel booking sendiri.

## Kalo mau dikembangin

Beberapa ide fitur tambahan:
- Simpan booking ke database (bikin tabel booking)
- Kirim email konfirmasi booking
- Payment gateway
- Admin panel buat kelola kamar
- Upload foto kamar
- Review & rating
- Cari kamar berdasarkan tanggal

Tapi buat pembelajaran, yang sekarang udah cukup kok.

## Lisensi

Bebas dipake buat belajar atau proyek pribadi. Kalo mau dikembangin lagi juga boleh.

---

Dibuat pake PHP, MySQL, sama sedikit JavaScript.
Semoga membantu!
