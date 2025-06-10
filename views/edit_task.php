<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Edit Task</h1>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="index.php?action=edit_task_submit">
        <input type="hidden" name="id" value="<?= $task['id'] ?>">

        <label>Title:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>"><br><br>

        <label>Description:</label><br>
        <textarea name="description"><?= htmlspecialchars($task['description']) ?></textarea><br><br>

        <label>Category:</label><br>
        <select name="category_id">
            <option value="">None</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= $task['category_id'] == $category['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Priority:</label><br>
        <select name="priority">
            <option value="low" <?= $task['priority'] === 'low' ? 'selected' : '' ?>>Low</option>
            <option value="medium" <?= $task['priority'] === 'medium' ? 'selected' : '' ?>>Medium</option>
            <option value="high" <?= $task['priority'] === 'high' ? 'selected' : '' ?>>High</option>
        </select><br><br>

        <label>Due Date:</label><br>
        <input type="datetime-local" name="due_date" value="<?= date('Y-m-d\TH:i', strtotime($task['due_date'])) ?>"><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="todo" <?= $task['status'] === 'todo' ? 'selected' : '' ?>>To Do</option>
            <option value="in_progress" <?= $task['status'] === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
            <option value="done" <?= $task['status'] === 'done' ? 'selected' : '' ?>>Done</option>
        </select><br><br>

        <button type="submit">Update Task</button>
    </form>
</body>
</html>
