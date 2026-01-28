# Sistem Login dengan PHP dan MySQL

Sistem login dan registrasi lengkap dengan PHP, MySQL, dan Bootstrap-style CSS.

## 📋 Fitur

- ✅ Registrasi user dengan validasi
- ✅ Login dengan email atau username
- ✅ Password hashing menggunakan bcrypt
- ✅ Session management
- ✅ Remember me functionality
- ✅ Dashboard setelah login
- ✅ Logout system
- ✅ Error handling dan validation
- ✅ Responsive design
- ✅ SQL Injection protection

## 📁 Struktur File

```
project/
│
├── config.php              # Konfigurasi database dan fungsi helper
├── database.sql            # SQL untuk setup database
│
├── login.php               # Halaman login
├── login_process.php       # Proses login
│
├── register.php            # Halaman registrasi
├── register_process.php    # Proses registrasi
│
├── dashboard.php           # Halaman dashboard (after login)
├── logout.php              # Proses logout
│
└── README.md              # Dokumentasi
```

## 🔧 Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi / MariaDB
- Web Server (Apache/Nginx) atau XAMPP/WAMP/MAMP
- Browser modern

## 📥 Instalasi

### 1. Install XAMPP (untuk Windows)

Download dan install XAMPP dari: https://www.apachefriends.org/

### 2. Setup Database

1. Jalankan XAMPP Control Panel
2. Start Apache dan MySQL
3. Buka phpMyAdmin di browser: `http://localhost/phpmyadmin`
4. Buat database baru dengan nama `user_login_system`
5. Import file `database.sql`:
   - Klik database `user_login_system`
   - Klik tab "SQL"
   - Copy-paste isi file `database.sql` atau gunakan "Import"
   - Klik "Go" atau "Execute"

### 3. Konfigurasi File

1. Copy semua file PHP ke folder `htdocs/login-system/` (untuk XAMPP)
   - Lokasi default XAMPP: `C:\xampp\htdocs\login-system\`

2. Edit file `config.php` jika perlu (sesuaikan dengan konfigurasi database Anda):
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');  // Password MySQL (kosong untuk default XAMPP)
   define('DB_NAME', 'user_login_system');
   ```

### 4. Jalankan Aplikasi

Buka browser dan akses: `http://localhost/login-system/login.php`

## 👤 User Testing

Setelah import database, Anda bisa login dengan:
- **Username**: admin
- **Email**: admin@example.com
- **Password**: password123

## 🚀 Cara Menggunakan

### Registrasi User Baru

1. Buka `http://localhost/login-system/register.php`
2. Isi form registrasi:
   - Nama Depan
   - Nama Belakang
   - Email (harus unik)
   - Username (minimal 4 karakter, harus unik)
   - Password (minimal 8 karakter)
   - Konfirmasi Password
3. Centang "Syarat & Ketentuan"
4. Klik "Daftar Sekarang"
5. Jika berhasil, akan redirect ke halaman login

### Login

1. Buka `http://localhost/login-system/login.php`
2. Masukkan email/username dan password
3. (Opsional) Centang "Ingat saya" untuk remember me
4. Klik "Masuk"
5. Jika berhasil, akan redirect ke dashboard

### Dashboard

Setelah login berhasil, Anda akan melihat:
- Informasi akun (nama, username, email)
- Status akun
- Statistik (total login, member sejak, last login)
- Tombol logout

### Logout

1. Klik tombol "Logout" di dashboard
2. Session akan dihapus
3. Redirect ke halaman login

## 🔒 Fitur Keamanan

### 1. Password Hashing
```php
// Password di-hash menggunakan bcrypt
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Verifikasi password
password_verify($password, $hashed_password);
```

### 2. SQL Injection Prevention
```php
// Input dibersihkan menggunakan mysqli_real_escape_string
$username = mysqli_real_escape_string($conn, $_POST['username']);
```

### 3. Session Management
```php
// Cek apakah user sudah login
if (!is_logged_in()) {
    redirect('login.php');
}
```

### 4. Input Validation
- Email format validation
- Password strength checking
- Username uniqueness check
- Required fields validation

## 📊 Struktur Database

### Tabel: users

| Field       | Type         | Keterangan                    |
|-------------|--------------|-------------------------------|
| id          | INT(11)      | Primary Key, Auto Increment   |
| first_name  | VARCHAR(50)  | Nama depan                    |
| last_name   | VARCHAR(50)  | Nama belakang                 |
| username    | VARCHAR(50)  | Username (unique)             |
| email       | VARCHAR(100) | Email (unique)                |
| password    | VARCHAR(255) | Password (hashed)             |
| created_at  | TIMESTAMP    | Waktu registrasi              |
| updated_at  | TIMESTAMP    | Waktu update terakhir         |
| last_login  | TIMESTAMP    | Waktu login terakhir          |
| status      | ENUM         | Status akun (active/inactive) |

## 🛠️ Troubleshooting

### Error: "Connection refused" atau "Can't connect to MySQL"
**Solusi**: 
- Pastikan MySQL sudah berjalan di XAMPP
- Cek username dan password di `config.php`

### Error: "Table 'users' doesn't exist"
**Solusi**: 
- Import file `database.sql` di phpMyAdmin
- Pastikan database `user_login_system` sudah dibuat

### Halaman blank atau error 500
**Solusi**: 
- Cek PHP error log di `C:\xampp\apache\logs\error.log`
- Pastikan semua file PHP berada di folder yang benar
- Cek apakah PHP extension MySQLi sudah aktif di `php.ini`

### Session tidak tersimpan
**Solusi**: 
- Pastikan `session_start()` dipanggil di awal setiap file
- Cek permission folder session di server

## 🔄 Upgrade & Pengembangan

### Fitur yang Bisa Ditambahkan:

1. **Forgot Password**
   - Email reset password
   - Token verification

2. **Email Verification**
   - Send verification email saat registrasi
   - Verify email sebelum login

3. **Role Management**
   - Admin, User, Moderator roles
   - Permission system

4. **Profile Management**
   - Edit profile
   - Change password
   - Upload avatar

5. **Two-Factor Authentication (2FA)**
   - Google Authenticator
   - SMS verification

6. **Social Login**
   - Google OAuth
   - Facebook Login

7. **Activity Log**
   - Track user activity
   - Login history

## 📞 Support

Jika ada masalah atau pertanyaan:
1. Cek bagian Troubleshooting
2. Periksa PHP error log
3. Pastikan semua konfigurasi sudah benar

## 📝 Lisensi

Free to use untuk pembelajaran dan proyek pribadi.

## 🎯 Tips Pengembangan

1. **Selalu gunakan prepared statements** untuk query database yang lebih aman
2. **Implementasi HTTPS** untuk production
3. **Gunakan environment variables** untuk konfigurasi sensitif
4. **Backup database** secara berkala
5. **Implementasi rate limiting** untuk prevent brute force attack
6. **Gunakan CSRF token** untuk form security

## ✅ Checklist Deploy ke Production

- [ ] Ganti password database
- [ ] Aktifkan HTTPS
- [ ] Set error_reporting ke 0
- [ ] Gunakan prepared statements
- [ ] Implementasi CSRF protection
- [ ] Set session cookie secure flag
- [ ] Backup database
- [ ] Test semua fitur
- [ ] Set proper file permissions

---

**Dibuat dengan ❤️ menggunakan PHP dan MySQL**
