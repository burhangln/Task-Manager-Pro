<?php
function getPDO() {
    $host = 'localhost';
    $dbname = 'task_manager_pro';
    $username = 'root';
    $password = ''; // şifre genelde boş olur

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Bağlantı hatası: " . $e->getMessage());
    }
}
