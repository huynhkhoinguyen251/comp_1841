<?php
require '../config/database_function.php';
require '../header.php';

// Require admin privileges
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    createModule($pdo, $_POST['name'], $_POST['description']);
    header('Location: modules.php');
    exit;
}

require '../templates/module_create.html.php';
require '../footer.php';
?>
<link rel="stylesheet" href="../css/style.css">