<?php
require '../config/database_function.php';
require '../header.php';

// Require admin privileges
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    createUser($pdo, $_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);
    header('Location: users.php');
    exit;
}

require '../templates/user_create.html.php';
require '../footer.php';
?>
<link rel="stylesheet" href="../css/style.css">