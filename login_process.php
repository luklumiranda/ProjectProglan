<?php
// login_process.php - Proses login user

require_once 'config.php';

// Cek apakah request method adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil dan bersihkan data dari form
    $email_or_username = clean_input($_POST['email']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? true : false;
    
    // Array untuk menyimpan error
    $errors = array();
    
    // Validasi input
    if (empty($email_or_username)) {
        $errors[] = "Email atau username harus diisi";
    }
    
    if (empty($password)) {
        $errors[] = "Password harus diisi";
    }
    
    // Jika tidak ada error, proses login
    if (empty($errors)) {
        // Query untuk cari user berdasarkan email atau username
        $sql = "SELECT * FROM users WHERE (email = '$email_or_username' OR username = '$email_or_username') AND status = 'active' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Login berhasil
                
                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['email'] = $user['email'];
                
                // Update last login
                $user_id = $user['id'];
                $update_login = "UPDATE users SET last_login = NOW() WHERE id = $user_id";
                mysqli_query($conn, $update_login);
                
                // Jika remember me di-check, set cookie untuk 30 hari
                if ($remember) {
                    $cookie_value = base64_encode($user['id'] . ':' . $user['username']);
                    setcookie('remember_user', $cookie_value, time() + (86400 * 30), '/'); // 30 hari
                }
                
                // Redirect ke homepage hotel
                redirect('home.php');
                
            } else {
                $errors[] = "Password salah";
            }
        } else {
            $errors[] = "User tidak ditemukan atau tidak aktif";
        }
    }
    
    // Jika ada error, simpan di session dan redirect kembali
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['login_email'] = $email_or_username;
        redirect('login.php');
    }
    
} else {
    // Jika bukan POST request, redirect ke halaman login
    redirect('login.php');
}

mysqli_close($conn);
?>