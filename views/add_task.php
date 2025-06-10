<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Add New Task</h1>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="index.php?action=add_task_submit">
        <label>Title:</label><br>
        <input type="text" name="title"><br><br>

        <label>Description:</label><br>
        <textarea name="description"></textarea><br><br>

        <label>Category:</label><br>
        <select name="category_id">
            <option value="">None</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Priority:</label><br>
        <select name="priority">
            <option value="low">Low</option>
            <option value="medium" selected>Medium</option>
            <option value="high">High</option>
        </select><br><br>

        <label>Due Date:</label><br>
        <input type="datetime-local" name="due_date"><br><br>

        <button type="submit">Add Task</button>
    </form>
</body>
</html>
