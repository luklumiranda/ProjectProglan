<?php
// booking.php - Halaman booking kamar hotel

require_once 'config.php';

// Cek apakah user sudah login
if (!is_logged_in()) {
    redirect('login.php');
}

// Ambil data user dari session
$first_name = $_SESSION['first_name'];
$username = $_SESSION['username'];

// Ambil tipe kamar dari URL
$room_type = isset($_GET['room']) ? clean_input($_GET['room']) : 'standard';

// Data kamar
$rooms = [
    'standard' => [
        'name' => 'Standard Room',
        'price' => 500000,
        'icon' => '🛏️',
        'description' => 'Kamar nyaman dengan fasilitas standar'
    ],
    'deluxe' => [
        'name' => 'Deluxe Room',
        'price' => 850000,
        'icon' => '🏨',
        'description' => 'Kamar yang lebih luas dengan pemandangan kota'
    ],
    'suite' => [
        'name' => 'Suite Room',
        'price' => 1500000,
        'icon' => '👑',
        'description' => 'Suite mewah dengan ruang tamu terpisah'
    ]
];

$selected_room = $rooms[$room_type] ?? $rooms['standard'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Hotel Paradise</title>
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
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
        }

        .back-btn {
            display: inline-block;
            color: white;
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .back-btn:hover {
            opacity: 0.8;
        }

        .booking-card {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .booking-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .room-icon {
            font-size: 72px;
            margin-bottom: 15px;
        }

        .booking-header h1 {
            color: #333;
            margin-bottom: 10px;
        }

        .booking-header p {
            color: #666;
        }

        .room-price-display {
            background: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
        }

        .room-price-display h2 {
            color: #667eea;
            font-size: 36px;
            margin-bottom: 5px;
        }

        .room-price-display p {
            color: #666;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .summary-box {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .summary-box h3 {
            color: #333;
            margin-bottom: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .summary-item:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 18px;
            color: #667eea;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: transform 0.2s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .booking-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="home.php" class="back-btn">← Kembali ke Home</a>
        
        <div class="booking-card">
            <div class="booking-header">
                <div class="room-icon"><?php echo $selected_room['icon']; ?></div>
                <h1>Booking <?php echo $selected_room['name']; ?></h1>
                <p><?php echo $selected_room['description']; ?></p>
            </div>

            <div class="room-price-display">
                <h2>Rp <?php echo number_format($selected_room['price'], 0, ',', '.'); ?></h2>
                <p>per malam</p>
            </div>

            <form id="bookingForm" method="POST" action="booking_process.php">
                <input type="hidden" name="room_type" value="<?php echo $room_type; ?>">
                <input type="hidden" name="room_price" value="<?php echo $selected_room['price']; ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label for="check_in">Check-in</label>
                        <input type="date" id="check_in" name="check_in" required min="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="check_out">Check-out</label>
                        <input type="date" id="check_out" name="check_out" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="guests">Jumlah Tamu</label>
                        <select id="guests" name="guests" required>
                            <option value="1">1 Tamu</option>
                            <option value="2">2 Tamu</option>
                            <option value="3">3 Tamu</option>
                            <option value="4">4 Tamu</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone" placeholder="08xxxxxxxxxx" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="special_request">Permintaan Khusus (Opsional)</label>
                    <textarea id="special_request" name="special_request" rows="4" placeholder="Contoh: Lantai tinggi, non-smoking room, extra bed, dll."></textarea>
                </div>

                <div class="summary-box">
                    <h3>Ringkasan Booking</h3>
                    <div class="summary-item">
                        <span>Tipe Kamar:</span>
                        <span><?php echo $selected_room['name']; ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Harga per Malam:</span>
                        <span>Rp <?php echo number_format($selected_room['price'], 0, ',', '.'); ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Jumlah Malam:</span>
                        <span id="nights">-</span>
                    </div>
                    <div class="summary-item">
                        <span>Total Harga:</span>
                        <span id="total_price">Rp 0</span>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Konfirmasi Booking</button>
            </form>
        </div>
    </div>

    <script>
        const checkIn = document.getElementById('check_in');
        const checkOut = document.getElementById('check_out');
        const nightsDisplay = document.getElementById('nights');
        const totalPriceDisplay = document.getElementById('total_price');
        const roomPrice = <?php echo $selected_room['price']; ?>;

        function calculateTotal() {
            if (checkIn.value && checkOut.value) {
                const start = new Date(checkIn.value);
                const end = new Date(checkOut.value);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays > 0) {
                    nightsDisplay.textContent = diffDays + ' malam';
                    const total = diffDays * roomPrice;
                    totalPriceDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
                } else {
                    nightsDisplay.textContent = '-';
                    totalPriceDisplay.textContent = 'Rp 0';
                }
            }
        }

        checkIn.addEventListener('change', function() {
            // Set minimum checkout date
            const minCheckout = new Date(this.value);
            minCheckout.setDate(minCheckout.getDate() + 1);
            checkOut.min = minCheckout.toISOString().split('T')[0];
            calculateTotal();
        });

        checkOut.addEventListener('change', calculateTotal);

        // Set default dates
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        checkIn.value = today.toISOString().split('T')[0];
        checkOut.value = tomorrow.toISOString().split('T')[0];
        calculateTotal();
    </script>
</body>
</html>