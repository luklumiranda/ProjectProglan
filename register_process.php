<?php
// register_process.php - Proses registrasi user

require_once 'config.php';

// Cek apakah request method adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil dan bersihkan data dari form
    $first_name = clean_input($_POST['firstName']);
    $last_name = clean_input($_POST['lastName']);
    $username = clean_input($_POST['username']);
    $email = clean_input($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    
    // Array untuk menyimpan error
    $errors = array();
    
    // Validasi input
    if (empty($first_name)) {
        $errors[] = "Nama depan harus diisi";
    }
    
    if (empty($last_name)) {
        $errors[] = "Nama belakang harus diisi";
    }
    
    if (empty($username)) {
        $errors[] = "Username harus diisi";
    } elseif (strlen($username) < 4) {
        $errors[] = "Username minimal 4 karakter";
    }
    
    if (empty($email)) {
        $errors[] = "Email harus diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }
    
    if (empty($password)) {
        $errors[] = "Password harus diisi";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password minimal 8 karakter";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Password dan konfirmasi password tidak cocok";
    }
    
    // Cek apakah username sudah ada
    $check_username = "SELECT id FROM users WHERE username = '$username'";
    $result_username = mysqli_query($conn, $check_username);
    if (mysqli_num_rows($result_username) > 0) {
        $errors[] = "Username sudah digunakan";
    }
    
    // Cek apakah email sudah ada
    $check_email = "SELECT id FROM users WHERE email = '$email'";
    $result_email = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($result_email) > 0) {
        $errors[] = "Email sudah terdaftar";
    }
    
    // Jika tidak ada error, proses registrasi
    if (empty($errors)) {
        // Hash password menggunakan bcrypt
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Query insert data user
        $sql = "INSERT INTO users (first_name, last_name, username, email, password) 
                VALUES ('$first_name', '$last_name', '$username', '$email', '$hashed_password')";
        
        if (mysqli_query($conn, $sql)) {
            // Registrasi berhasil
            $_SESSION['success_message'] = "Registrasi berhasil! Silakan login.";
            redirect('login.php');
        } else {
            $errors[] = "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }
    
    // Jika ada error, simpan di session dan redirect kembali
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        redirect('register.php');
    }
    
} else {
    // Jika bukan POST request, redirect ke halaman register
    redirect('register.php');
}

mysqli_close($conn);
?>
