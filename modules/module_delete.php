<?php
require '../config/database_function.php';
require '../header.php';

// Require admin privileges
requireAdmin();

$id = $_GET['id'] ?? 0;

if ($id) {
    deleteModule($pdo, $id);
}

header('Location: modules.php');
exit;
?>
<link rel="stylesheet" href="../css/style.css">