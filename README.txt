
TaskManagerPro
==============
TaskManagerPro is a PHP-based web application for managing personal tasks with user authentication, category assignment, task creation, editing, deletion, and search capabilities. Built with MySQL and Bootstrap 5, it provides a simple and responsive user interface.

Setup Instructions
------------------
1. Install XAMPP and start Apache and MySQL services.
2. Create a MySQL database named `task_manager_pro` using phpMyAdmin.
3. Create the `users`, `categories`, and `tasks` tables manually using the provided SQL schema.
4. Copy all project files to `C:\xampp\htdocs\task_manager_pro`.
5. Update `config.php` with your database credentials (default: host=localhost, user=root, password=``).
6. Open the application in your browser:
   http://localhost/task_manager_pro/public/index.php

Usage Guide
-----------
1. Register
   Go to `/index.php?action=register` and create a new account using a username, email, and password.

2. Login
   Access `/index.php?action=login` and log in with your account credentials.

3. Task Management
   - Create tasks at `/index.php?action=add_task` by entering title, description, category, priority, and optional due date.
   - View your tasks at `/index.php?action=tasks`. Tasks are listed in descending order by creation time.
   - Edit tasks via the "Edit" button.
   - Delete tasks via the "Delete" link, with confirmation.
   - Search tasks by title or description using the search bar on the task list page.

4. Category Selection
   - While adding or editing a task, select a category if available.
   - Categories are user-specific, but no default categories are created automatically.

Features
--------
- User Authentication: Registration and login system using email validation and password hashing.
- Task Management (CRUD): Create, read, update, and delete tasks with title, description, category, priority, due date, and status.
- Task Deletion: Delete tasks only if you are the owner.
- Task Search: Search tasks by title or description.
- Responsive Design: Uses Bootstrap 5 for mobile-friendly layout.
- Security: Uses PDO with prepared statements to prevent SQL injection and `htmlspecialchars()` to avoid XSS.

Notes
-----
- PHP session handling must be enabled.
- Project currently does not include task reports, default categories, sorting or toggle functionality.
- You can test user-based isolation by creating multiple users and checking if tasks are separated.
- SQL tables include necessary foreign keys for basic relational integrity.

Developer
---------
- Name: Burhan Gülen
- Course: MVC Web Application Development L2
- Student ID: 44960
