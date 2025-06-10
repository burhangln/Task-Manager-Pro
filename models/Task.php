<?php
require_once(__DIR__ . '/../config.php');

class Task {

    public static function add($user_id, $category_id, $title, $description, $priority, $due_date) {
        $pdo = getPDO();

        $stmt = $pdo->prepare("
            INSERT INTO tasks (user_id, category_id, title, description, priority, due_date)
            VALUES (:user_id, :category_id, :title, :description, :priority, :due_date)
        ");

        $stmt->execute([
            'user_id' => $user_id,
            'category_id' => $category_id ?: null,
            'title' => $title,
            'description' => $description,
            'priority' => $priority,
            'due_date' => $due_date ?: null
        ]);
    }

    public static function delete($id, $user_id) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
        $stmt->execute(['id' => $id, 'user_id' => $user_id]);
    }

    public static function search($user_id, $query) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("
            SELECT tasks.*, categories.name AS category_name
            FROM tasks
            LEFT JOIN categories ON tasks.category_id = categories.id
            WHERE tasks.user_id = :user_id
            AND (tasks.title LIKE :query OR tasks.description LIKE :query)
            ORDER BY tasks.created_at DESC
        ");
        $stmt->execute([
            'user_id' => $user_id,
            'query' => "%$query%"
        ]);
        return $stmt->fetchAll();
    }

    public static function getAllByUser($user_id) {
        $pdo = getPDO();

        $stmt = $pdo->prepare("
            SELECT tasks.*, categories.name AS category_name
            FROM tasks
            LEFT JOIN categories ON tasks.category_id = categories.id
            WHERE tasks.user_id = :user_id
            ORDER BY tasks.created_at DESC
        ");

        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll();
    }

    public static function getById($task_id, $user_id) {
        $pdo = getPDO();

        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id AND user_id = :user_id");
        $stmt->execute(['id' => $task_id, 'user_id' => $user_id]);
        return $stmt->fetch();
    }

    public static function update($id, $user_id, $category_id, $title, $description, $priority, $due_date, $status) {
        $pdo = getPDO();

        $stmt = $pdo->prepare("
            UPDATE tasks SET
                category_id = :category_id,
                title = :title,
                description = :description,
                priority = :priority,
                due_date = :due_date,
                status = :status,
                completed_at = IF(:status = 'done', NOW(), NULL)
            WHERE id = :id AND user_id = :user_id
        ");

        $stmt->execute([
            'id' => $id,
            'user_id' => $user_id,
            'category_id' => $category_id ?: null,
            'title' => $title,
            'description' => $description,
            'priority' => $priority,
            'due_date' => $due_date ?: null,
            'status' => $status
        ]);
    }
}
