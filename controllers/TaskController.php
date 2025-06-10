<?php
require_once(__DIR__ . '/../models/Task.php');
require_once(__DIR__ . '/../models/Category.php');

function showTaskList() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $query = $_GET['q'] ?? '';
    if ($query) {
        $tasks = Task::search($_SESSION['user_id'], $query);
    } else {
        $tasks = Task::getAllByUser($_SESSION['user_id']);
    }

    include(__DIR__ . '/../views/task_list.php');
}

function showAddTaskForm() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $categories = Category::getByUser($_SESSION['user_id']);
    $error = '';
    include(__DIR__ . '/../views/add_task.php');
}

function handleAddTask() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category_id = $_POST['category_id'] ?? null;
    $priority = $_POST['priority'] ?? 'medium';
    $due_date = $_POST['due_date'] ?? null;
    $error = '';

    if (empty($title)) {
        $error = "Title is required.";
        $categories = Category::getByUser($_SESSION['user_id']);
        include(__DIR__ . '/../views/add_task.php');
        return;
    }

    Task::add($_SESSION['user_id'], $category_id, $title, $description, $priority, $due_date);
    header("Location: index.php?action=tasks");
    exit;
}

function showEditTaskForm() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $task = Task::getById($_GET['id'], $_SESSION['user_id']);
    if (!$task) {
        echo "Task not found.";
        return;
    }
    $categories = Category::getByUser($_SESSION['user_id']);
    $error = '';
    include(__DIR__ . '/../views/edit_task.php');
}

function handleEditTaskSubmit() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category_id = $_POST['category_id'] ?? null;
    $priority = $_POST['priority'] ?? 'medium';
    $due_date = $_POST['due_date'] ?? null;
    $status = $_POST['status'] ?? 'todo';

    if (empty($title)) {
        $error = "Title is required.";
        $task = Task::getById($id, $_SESSION['user_id']);
        $categories = Category::getByUser($_SESSION['user_id']);
        include(__DIR__ . '/../views/edit_task.php');
        return;
    }

    Task::update($id, $_SESSION['user_id'], $category_id, $title, $description, $priority, $due_date, $status);
    header("Location: index.php?action=tasks");
    exit;
}

function handleDeleteTask() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $id = $_GET['id'] ?? null;
    if ($id) {
        Task::delete($id, $_SESSION['user_id']);
    }

    header("Location: index.php?action=tasks");
    exit;
}
