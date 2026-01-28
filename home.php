
<?php
// home.php - Homepage Hotel setelah login

require_once 'config.php';

// Cek apakah user sudah login
if (!is_logged_in()) {
    redirect('login.php');
}

// Ambil data user dari session
$first_name = $_SESSION['first_name'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Paradise - Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-menu {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        .nav-menu a:hover {
            opacity: 0.8;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: white;
            color: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .btn-logout {
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn-logout:hover {
            background: white;
            color: #667eea;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%23667eea" width="1200" height="600"/><path fill="%23764ba2" d="M0 300L50 283.3C100 266.7 200 233.3 300 233.3C400 233.3 500 266.7 600 283.3C700 300 800 300 900 283.3C1000 266.7 1100 233.3 1150 216.7L1200 200V600H1150C1100 600 1000 600 900 600C800 600 700 600 600 600C500 600 400 600 300 600C200 600 100 600 50 600H0V300Z"/></svg>');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 100px 20px;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .btn-primary {
            display: inline-block;
            padding: 15px 40px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 16px;
            transition: transform 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        /* Features Section */
        .features {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .section-title {
            text-align: center;
            font-size: 36px;
            color: #333;
            margin-bottom: 50px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 22px;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
        }

        /* Rooms Section */
        .rooms {
            background: #f9f9f9;
            padding: 60px 20px;
        }

        .rooms-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .room-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .room-image {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 72px;
        }

        .room-info {
            padding: 25px;
        }

        .room-info h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .room-info p {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .room-price {
            font-size: 28px;
            color: #667eea;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .room-price span {
            font-size: 16px;
            color: #999;
            font-weight: normal;
        }

        .btn-book {
            display: block;
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .btn-book:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        /* Footer */
        .footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 30px 20px;
            margin-top: 60px;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: #667eea;
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                gap: 15px;
                font-size: 14px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero p {
                font-size: 16px;
            }

            .section-title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                🏨 Hotel Paradise
            </div>
            <div class="nav-menu">
                <a href="home.php">Home</a>
                <a href="#rooms">Kamar</a>
                <a href="#facilities">Fasilitas</a>
                <a href="dashboard.php">Dashboard</a>
                <div class="user-info">
                    <div class="user-avatar"><?php echo strtoupper(substr($first_name, 0, 1)); ?></div>
                    <span><?php echo htmlspecialchars($first_name); ?></span>
                    <a href="logout.php" class="btn-logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Selamat Datang di Hotel Paradise</h1>
        <p>Nikmati pengalaman menginap yang tak terlupakan dengan pelayanan terbaik</p>
        <a href="#rooms" class="btn-primary">Pesan Kamar Sekarang</a>
    </section>

    <!-- Features Section -->
    <section class="features" id="facilities">
        <h2 class="section-title">Fasilitas Kami</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🏊</div>
                <h3>Kolam Renang</h3>
                <p>Kolam renang outdoor dengan pemandangan menakjubkan tersedia 24 jam untuk kenyamanan Anda</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🍽️</div>
                <h3>Restaurant</h3>
                <p>Restoran dengan menu internasional dan lokal yang disajikan oleh chef profesional</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💆</div>
                <h3>Spa & Wellness</h3>
                <p>Fasilitas spa lengkap untuk relaksasi dan perawatan tubuh Anda</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🏋️</div>
                <h3>Fitness Center</h3>
                <p>Gym modern dengan peralatan lengkap untuk menjaga kebugaran Anda</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📶</div>
                <h3>Free WiFi</h3>
                <p>Internet berkecepatan tinggi tersedia di seluruh area hotel</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🚗</div>
                <h3>Parkir Gratis</h3>
                <p>Area parkir luas dan aman untuk kendaraan Anda</p>
            </div>
        </div>
    </section>

    <!-- Rooms Section -->
    <section class="rooms" id="rooms">
        <div class="rooms-container">
            <h2 class="section-title">Pilihan Kamar</h2>
            <div class="rooms-grid">
                <!-- Standard Room -->
                <div class="room-card">
                    <div class="room-image">🛏️</div>
                    <div class="room-info">
                        <h3>Standard Room</h3>
                        <p>Kamar nyaman dengan fasilitas standar untuk menginap yang menyenangkan. Dilengkapi AC, TV, dan kamar mandi dalam.</p>
                        <div class="room-price">
                            Rp 500.000 <span>/ malam</span>
                        </div>
                        <a href="booking.php?room=standard" class="btn-book">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Deluxe Room -->
                <div class="room-card">
                    <div class="room-image">🏨</div>
                    <div class="room-info">
                        <h3>Deluxe Room</h3>
                        <p>Kamar yang lebih luas dengan pemandangan kota. Termasuk minibar, balkon pribadi, dan WiFi premium.</p>
                        <div class="room-price">
                            Rp 850.000 <span>/ malam</span>
                        </div>
                        <a href="booking.php?room=deluxe" class="btn-book">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Suite Room -->
                <div class="room-card">
                    <div class="room-image">👑</div>
                    <div class="room-info">
                        <h3>Suite Room</h3>
                        <p>Suite mewah dengan ruang tamu terpisah, jacuzzi, dan pemandangan laut yang memukau. Pengalaman menginap terbaik.</p>
                        <div class="room-price">
                            Rp 1.500.000 <span>/ malam</span>
                        </div>
                        <a href="booking.php?room=suite" class="btn-book">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p><strong>Hotel Paradise</strong></p>
        <p>Jl. Raya Paradise No. 123, Jakarta 12345</p>
        <p>Telp: (021) 1234-5678 | Email: info@hotelparadise.com</p>
        <p style="margin-top: 20px;">© 2026 Hotel Paradise. All rights reserved.</p>
    </footer>
</body>
</html>