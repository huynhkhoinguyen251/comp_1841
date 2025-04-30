<?php
require '../config/database_function.php';
require '../header.php';

// Require admin privileges
requireAdmin();

// Fetch all modules
$modules = getAllModules($pdo);

require '../templates/module.html.php';
require '../footer.php';
?>
<link rel="stylesheet" href="../css/style.css">