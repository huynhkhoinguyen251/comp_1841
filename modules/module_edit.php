<?php
require '../config/database_function.php';
require '../header.php';

// Require admin privileges
requireAdmin();

$id = $_GET['id'] ?? 0;
$module = getModuleById($pdo, $id);

if (!$module) {
    header('Location: modules.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateModule($pdo, $id, $_POST['name']);
    header('Location: modules.php');
    exit;
}

require '../templates/module_edit.html.php';
require '../footer.php';
?>
<link rel="stylesheet" href="../css/style.css">