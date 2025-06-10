<?php
require_once(__DIR__ . '/../models/User.php');

function handleRegister() {
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (empty($username) || empty($email) || empty($password)) {
            $error = "Lütfen tüm alanları doldurun.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Geçerli bir e-posta girin.";
        } else {
            $result = User::register($username, $email, $password);
            if ($result === true) {
                header("Location: index.php?action=login");
                exit;
            } else {
                $error = $result;
            }
        }
    }

    include(__DIR__ . '/../views/register.php');
}

function handleLogin() {
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $error = "Kullanıcı adı ve şifre boş olamaz.";
        } else {
            $userId = User::login($username, $password);
            if ($userId) {
                session_start();
                $_SESSION['user_id'] = $userId;
                header("Location: index.php?action=tasks");
                exit;
            } else {
                $error = "Kullanıcı adı veya şifre hatalı.";
            }
        }
    }

    include(__DIR__ . '/../views/login.php');
}
