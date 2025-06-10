<!DOCTYPE html>
<html>
<head>
    <title>My Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1 class="mb-4">Your Tasks</h1>

    <a href="index.php?action=add_task" class="btn btn-primary mb-3">Add New Task</a>

    <form method="GET" action="index.php" class="mb-4">
        <input type="hidden" name="action" value="tasks">
        <input type="text" name="q" placeholder="Search tasks..." class="form-control mb-2" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        <button type="submit" class="btn btn-secondary">Search</button>
    </form>

    <ul class="list-group">
        <?php foreach ($tasks as $task): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong><?= htmlspecialchars($task['title']) ?></strong>
                    (<?= htmlspecialchars($task['priority']) ?>)
                    <?php if ($task['category_name']): ?>
                        - <?= htmlspecialchars($task['category_name']) ?>
                    <?php endif; ?>
                    <?php if ($task['due_date']): ?>
                        - Due: <?= htmlspecialchars($task['due_date']) ?>
                    <?php endif; ?>
                </div>
                <div>
                    <a href="index.php?action=edit_task&id=<?= $task['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                    <a href="index.php?action=delete_task&id=<?= $task['id'] ?>"
                       class="btn btn-sm btn-outline-danger"
                       onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
