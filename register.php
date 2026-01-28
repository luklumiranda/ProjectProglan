<?php
require_once 'config.php';

// Jika sudah login, redirect ke dashboard
if (is_logged_in()) {
    redirect('dashboard.php');
}

// Ambil error messages dan form data jika ada
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : array();

// Hapus session messages setelah ditampilkan
unset($_SESSION['errors']);
unset($_SESSION['form_data']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Daftar Akun</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .register-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .register-header p {
            color: #666;
            font-size: 14px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert ul li {
            margin: 5px 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .password-strength {
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s;
            border-radius: 2px;
        }

        .password-strength-bar.weak {
            width: 33%;
            background: #ff4444;
        }

        .password-strength-bar.medium {
            width: 66%;
            background: #ffaa00;
        }

        .password-strength-bar.strong {
            width: 100%;
            background: #00cc66;
        }

        .password-hint {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        .terms-agreement {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .terms-agreement label {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            cursor: pointer;
        }

        .terms-agreement input[type="checkbox"] {
            margin-top: 3px;
            cursor: pointer;
        }

        .terms-agreement a {
            color: #667eea;
            text-decoration: none;
        }

        .terms-agreement a:hover {
            text-decoration: underline;
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
            color: #999;
            font-size: 14px;
        }

        .social-login {
            display: flex;
            gap: 10px;
        }

        .social-btn {
            flex: 1;
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            background: white;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .social-btn:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 30px 20px;
            }

            .register-header h1 {
                font-size: 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>Daftar Akun Baru</h1>
            <p>Bergabunglah dengan kami sekarang</p>
        </div>

        <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="register_process.php" method="POST" id="registerForm">
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">Nama Depan</label>
                    <input type="text" id="firstName" name="firstName" 
                           placeholder="Nama depan" 
                           value="<?php echo isset($form_data['firstName']) ? htmlspecialchars($form_data['firstName']) : ''; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="lastName">Nama Belakang</label>
                    <input type="text" id="lastName" name="lastName" 
                           placeholder="Nama belakang"
                           value="<?php echo isset($form_data['lastName']) ? htmlspecialchars($form_data['lastName']) : ''; ?>"
                           required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" 
                       placeholder="nama@email.com"
                       value="<?php echo isset($form_data['email']) ? htmlspecialchars($form_data['email']) : ''; ?>"
                       required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" 
                       placeholder="Pilih username"
                       value="<?php echo isset($form_data['username']) ? htmlspecialchars($form_data['username']) : ''; ?>"
                       required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" 
                       placeholder="Buat password" 
                       required>
                <div class="password-strength">
                    <div class="password-strength-bar" id="strengthBar"></div>
                </div>
                <p class="password-hint">Minimal 8 karakter, gunakan kombinasi huruf, angka & simbol</p>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Konfirmasi Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" 
                       placeholder="Ketik ulang password" 
                       required>
            </div>

            <div class="terms-agreement">
                <label>
                    <input type="checkbox" id="terms" name="terms" required>
                    <span>Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a></span>
                </label>
            </div>

            <button type="submit" class="btn-register">Daftar Sekarang</button>
        </form>

        <div class="divider">
            <span>atau daftar dengan</span>
        </div>

        <div class="social-login">
            <button class="social-btn" type="button">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Google
            </button>
            <button class="social-btn" type="button">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#1877F2">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                Facebook
            </button>
        </div>

        <div class="login-link">
            Sudah punya akun? <a href="login.php">Masuk di sini</a>
        </div>
    </div>

    <script>
        const password = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');

        // Password strength checker
        password.addEventListener('input', function() {
            const value = this.value;
            let strength = 0;

            if (value.length >= 8) strength++;
            if (value.match(/[a-z]/) && value.match(/[A-Z]/)) strength++;
            if (value.match(/[0-9]/)) strength++;
            if (value.match(/[^a-zA-Z0-9]/)) strength++;

            strengthBar.className = 'password-strength-bar';
            
            if (strength <= 1) {
                strengthBar.classList.add('weak');
            } else if (strength <= 3) {
                strengthBar.classList.add('medium');
            } else {
                strengthBar.classList.add('strong');
            }
        });
    </script>
</body>
</html>