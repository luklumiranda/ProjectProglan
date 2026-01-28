<?php
// config.php - File konfigurasi database

// Konfigurasi Database
define('DB_HOST', 'localhost');      // Host database (biasanya localhost)
define('DB_USER', 'root');           // Username database
define('DB_PASS', '');               // Password database (kosong untuk default XAMPP/WAMP)
define('DB_NAME', 'user_login_system'); // Nama database

// Konfigurasi Session
session_start();

// Koneksi ke Database menggunakan MySQLi
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset untuk mencegah masalah encoding
mysqli_set_charset($conn, "utf8mb4");

// Fungsi untuk membersihkan input (mencegah SQL Injection)
function clean_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

// Fungsi untuk cek apakah user sudah login
function is_logged_in() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Fungsi untuk redirect
function redirect($url) {
    header("Location: " . $url);
    exit();
}
?>
