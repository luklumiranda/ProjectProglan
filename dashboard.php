<?php
// dashboard.php - Halaman setelah login berhasil

require_once 'config.php';

// Cek apakah user sudah login, jika belum redirect ke login
if (!is_logged_in()) {
    redirect('login.php');
}

// Ambil data user dari session
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Selamat Datang</title>
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

        .navbar {
            background: white;
            padding: 15px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .navbar h2 {
            color: #667eea;
            font-size: 24px;
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar .user-name {
            font-weight: 600;
            color: #333;
        }

        .btn-logout {
            padding: 8px 20px;
            background: #ff4444;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn-logout:hover {
            background: #cc0000;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .welcome-card {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome-card h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 32px;
        }

        .welcome-card p {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .user-details {
            background: #f8f9ff;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: left;
        }

        .user-details h3 {
            color: #667eea;
            margin-bottom: 15px;
        }

        .detail-item {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #333;
            width: 150px;
        }

        .detail-value {
            color: #666;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-card h3 {
            color: #333;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .stat-card .stat-value {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
        }

        .success-badge {
            display: inline-block;
            background: #00cc66;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <h2>Dashboard</h2>
            <div class="user-info">
                <a href="home.php" style="padding: 8px 20px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; font-size: 14px; margin-right: 10px;">🏨 Hotel Home</a>
                <span class="user-name"><?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></span>
                <a href="logout.php" class="btn-logout">Logout</a>
            </div>
        </div>

        <div class="welcome-card">
            <h1>Selamat Datang, <?php echo htmlspecialchars($first_name); ?>! 🎉</h1>
            <p>Anda telah berhasil login ke sistem</p>
            <span class="success-badge">✓ Login Berhasil</span>

            <div class="user-details">
                <h3>Informasi Akun</h3>
                <div class="detail-item">
                    <div class="detail-label">Nama Lengkap:</div>
                    <div class="detail-value"><?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Username:</div>
                    <div class="detail-value"><?php echo htmlspecialchars($username); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email:</div>
                    <div class="detail-value"><?php echo htmlspecialchars($email); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value"><span style="color: #00cc66; font-weight: 600;">● Active</span></div>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Login</h3>
                <div class="stat-value">1</div>
            </div>
            <div class="stat-card">
                <h3>Member Sejak</h3>
                <div class="stat-value" style="font-size: 20px;">
                    <?php 
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT created_at FROM users WHERE id = $user_id";
                    $result = mysqli_query($conn, $query);
                    $user_data = mysqli_fetch_assoc($result);
                    echo date('d M Y', strtotime($user_data['created_at']));
                    ?>
                </div>
            </div>
            <div class="stat-card">
                <h3>Last Login</h3>
                <div class="stat-value" style="font-size: 20px;">
                    <?php 
                    $query = "SELECT last_login FROM users WHERE id = $user_id";
                    $result = mysqli_query($conn, $query);
                    $user_data = mysqli_fetch_assoc($result);
                    echo date('d M Y H:i', strtotime($user_data['last_login']));
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>