<?php
require '../config/database_function.php';
require '../header.php';

// Require admin privileges
requireAdmin();

$id = $_GET['id'] ?? 0;
$user = getUserById($pdo, $id);

if (!$user) {
    header('Location: users.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateUser($pdo, $id, $_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);
    header('Location: users.php');
    exit;
}

require '../templates/user_edit.html.php';
require '../footer.php';
?>
<link rel="stylesheet" href="../css/style.css">