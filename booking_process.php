<?php
// booking_process.php - Proses booking kamar hotel

require_once 'config.php';

// Cek apakah user sudah login
if (!is_logged_in()) {
    redirect('login.php');
}

// Cek apakah request method adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil data dari form
    $user_id = $_SESSION['user_id'];
    $room_type = clean_input($_POST['room_type']);
    $room_price = clean_input($_POST['room_price']);
    $check_in = clean_input($_POST['check_in']);
    $check_out = clean_input($_POST['check_out']);
    $guests = clean_input($_POST['guests']);
    $phone = clean_input($_POST['phone']);
    $special_request = clean_input($_POST['special_request']);
    
    // Hitung jumlah malam
    $start = new DateTime($check_in);
    $end = new DateTime($check_out);
    $diff = $start->diff($end);
    $nights = $diff->days;
    $total_price = $nights * $room_price;
    
    // Array untuk menyimpan error
    $errors = array();
    
    // Validasi input
    if (empty($check_in)) {
        $errors[] = "Tanggal check-in harus diisi";
    }
    
    if (empty($check_out)) {
        $errors[] = "Tanggal check-out harus diisi";
    }
    
    if ($nights <= 0) {
        $errors[] = "Tanggal check-out harus setelah check-in";
    }
    
    if (empty($phone)) {
        $errors[] = "Nomor telepon harus diisi";
    }
    
    // Jika tidak ada error, simpan booking
    if (empty($errors)) {
        // Untuk sementara, simpan ke session (dalam aplikasi nyata, simpan ke database)
        $_SESSION['booking_success'] = [
            'room_type' => $room_type,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'nights' => $nights,
            'guests' => $guests,
            'phone' => $phone,
            'special_request' => $special_request,
            'total_price' => $total_price,
            'booking_date' => date('Y-m-d H:i:s'),
            'booking_code' => 'HP-' . strtoupper(substr(md5(time()), 0, 8))
        ];
        
        redirect('booking_success.php');
    }
    
    // Jika ada error, simpan di session dan redirect kembali
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        redirect('booking.php?room=' . $room_type);
    }
    
} else {
    // Jika bukan POST request, redirect ke home
    redirect('home.php');
}

mysqli_close($conn);
?>