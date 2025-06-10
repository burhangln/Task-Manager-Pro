<?php
require_once(__DIR__ . '/../config.php');

class Category {
    public static function getByUser($user_id) {
        $pdo = getPDO();

        $stmt = $pdo->prepare("SELECT * FROM categories WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll();
    }
}
