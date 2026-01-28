<?php
// booking_success.php - Halaman konfirmasi booking berhasil

require_once 'config.php';

// Cek apakah user sudah login
if (!is_logged_in()) {
    redirect('login.php');
}

// Cek apakah ada data booking
if (!isset($_SESSION['booking_success'])) {
    redirect('home.php');
}

$booking = $_SESSION['booking_success'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];

// Hapus data booking dari session setelah ditampilkan
unset($_SESSION['booking_success']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Berhasil - Hotel Paradise</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .success-container {
            max-width: 700px;
            width: 100%;
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .success-icon {
            font-size: 80px;
            margin-bottom: 20px;
            animation: scaleIn 0.5s ease;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        .success-container h1 {
            color: #00cc66;
            margin-bottom: 10px;
            font-size: 32px;
        }

        .success-container p {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .booking-code {
            background: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .booking-code h2 {
            color: #333;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .booking-code .code {
            font-size: 32px;
            color: #667eea;
            font-weight: bold;
            font-family: 'Courier New', monospace;
        }

        .booking-details {
            text-align: left;
            background: #f9f9f9;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .booking-details h3 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #666;
            font-weight: 500;
        }

        .detail-value {
            color: #333;
            font-weight: 600;
        }

        .total-price {
            background: #667eea;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .total-price h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .total-price .price {
            font-size: 36px;
            font-weight: bold;
        }

        .buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .info-box {
            background: #fff9e6;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-top: 20px;
            text-align: left;
            border-radius: 5px;
        }

        .info-box p {
            color: #856404;
            margin: 0;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .success-container {
                padding: 30px 20px;
            }

            .buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">✅</div>
        <h1>Booking Berhasil!</h1>
        <p>Terima kasih telah melakukan booking di Hotel Paradise</p>

        <div class="booking-code">
            <h2>Kode Booking Anda</h2>
            <div class="code"><?php echo $booking['booking_code']; ?></div>
            <p style="margin-top: 10px; color: #999; font-size: 14px;">Simpan kode ini untuk check-in</p>
        </div>

        <div class="booking-details">
            <h3>Detail Booking</h3>
            <div class="detail-row">
                <span class="detail-label">Nama Tamu:</span>
                <span class="detail-value"><?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email:</span>
                <span class="detail-value"><?php echo htmlspecialchars($email); ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">No. Telepon:</span>
                <span class="detail-value"><?php echo htmlspecialchars($booking['phone']); ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tipe Kamar:</span>
                <span class="detail-value"><?php echo ucfirst($booking['room_type']); ?> Room</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Check-in:</span>
                <span class="detail-value"><?php echo date('d M Y', strtotime($booking['check_in'])); ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Check-out:</span>
                <span class="detail-value"><?php echo date('d M Y', strtotime($booking['check_out'])); ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Jumlah Malam:</span>
                <span class="detail-value"><?php echo $booking['nights']; ?> malam</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Jumlah Tamu:</span>
                <span class="detail-value"><?php echo $booking['guests']; ?> orang</span>
            </div>
            <?php if (!empty($booking['special_request'])): ?>
            <div class="detail-row">
                <span class="detail-label">Permintaan Khusus:</span>
                <span class="detail-value"><?php echo htmlspecialchars($booking['special_request']); ?></span>
            </div>
            <?php endif; ?>
        </div>

        <div class="total-price">
            <h3>Total Pembayaran</h3>
            <div class="price">Rp <?php echo number_format($booking['total_price'], 0, ',', '.'); ?></div>
            <p style="margin-top: 5px; font-size: 14px;">Dibayar saat check-in</p>
        </div>

        <div class="info-box">
            <p><strong>📧 Konfirmasi Email:</strong> Kami telah mengirim konfirmasi booking ke email Anda. Silakan cek inbox atau folder spam.</p>
        </div>

        <div class="buttons" style="margin-top: 30px;">
            <a href="home.php" class="btn btn-primary">Kembali ke Home</a>
            <a href="dashboard.php" class="btn btn-secondary">Lihat Dashboard</a>
        </div>
    </div>
</body>
</html>