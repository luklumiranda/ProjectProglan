-- Database setup untuk sistem login
-- Buat database baru
CREATE DATABASE IF NOT EXISTS user_login_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE user_login_system;

-- Tabel users untuk menyimpan data pengguna
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    INDEX idx_username (username),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contoh insert user untuk testing (password: password123)
-- Password sudah di-hash menggunakan password_hash()
INSERT INTO users (first_name, last_name, username, email, password) VALUES
('Admin', 'User', 'admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Note: Password untuk user testing di atas adalah "password123"
