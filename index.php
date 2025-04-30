<?php
require 'config/database_function.php';
require 'header.php';

// Fetch all posts
$posts = getAllPosts($pdo);

require 'templates/index.html.php';
require 'footer.php';
?>
<link rel="stylesheet" href="css/style.css">