<?php
require_once(__DIR__ . '/../config.php');

class User {

    public static function register($username, $email, $password) {
        $pdo = getPDO();

        // Kullanıcı adı ya da e-posta zaten var mı?
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $stmt->execute(['username' => $username, 'email' => $email]);
        if ($stmt->fetch()) {
            return "Bu kullanıcı adı veya e-posta zaten kullanılıyor.";
        }

        // Şifreyi hashle
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Veritabanına ekle
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        return true; // Başarılı
    }

    public static function login($username, $password) {
        $pdo = getPDO();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        } else {
            return false;
        }
    }
}
