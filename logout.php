<?php
// logout.php - Proses logout user

require_once 'config.php';

// Hapus semua session
session_unset();
session_destroy();

// Hapus cookie remember me jika ada
if (isset($_COOKIE['remember_user'])) {
    setcookie('remember_user', '', time() - 3600, '/');
}

// Redirect ke halaman login dengan pesan
$_SESSION['success_message'] = "Anda telah berhasil logout";
redirect('login.php');
?>
