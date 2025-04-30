<?php
require '../config/database_function.php';
require '../header.php';

// Require admin privileges
requireAdmin();

// Fetch all users
$users = getAllUsers($pdo);

require '../templates/user.html.php';
require '../footer.php';
?>
<link rel="stylesheet" href="../css/style.css">
