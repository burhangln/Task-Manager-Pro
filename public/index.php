<?php
session_start();

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'register':
        require_once(__DIR__ . '/../controllers/UserController.php');
        handleRegister();
        break;

    case 'login':
        require_once(__DIR__ . '/../controllers/UserController.php');
        handleLogin();
        break;

    case 'tasks':
        require_once(__DIR__ . '/../controllers/TaskController.php');
        showTaskList();
        break;

    case 'add_task':
        require_once(__DIR__ . '/../controllers/TaskController.php');
        showAddTaskForm();
        break;

    case 'add_task_submit':
        require_once(__DIR__ . '/../controllers/TaskController.php');
        handleAddTask();
        break;

    case 'delete_task':
        require_once(__DIR__ . '/../controllers/TaskController.php');
        handleDeleteTask();
        break;
    
    case 'edit_task':
        require_once(__DIR__ . '/../controllers/TaskController.php');
        showEditTaskForm();
        break;

    case 'edit_task_submit':
        require_once(__DIR__ . '/../controllers/TaskController.php');
        handleEditTaskSubmit();
        break;

    default:
        echo "404 Page Not Found";
        break;
}
