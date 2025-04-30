<?php
require '../config/database_function.php';
require '../header.php';

// Ensure user is logged in
requireLogin();

// Get post ID from URL
$id = $_GET['id'] ?? 0;

if ($id) {
    // Get the post details to check ownership
    $post = getPostById($pdo, $id);
    
    // Check if user is either admin or the post owner
    if (!isAdmin() && $post['user_id'] != $_SESSION['user_id']) {
        header('Location: /comp1841/index.php?error=permission');
        exit;
    }
    
    // Fetch and delete image file if it exists
    $img = getPostImage($pdo, $id);
    if ($img) {
        @unlink("../uploads/$img");
    }
    deletePost($pdo, $id);
}

header('Location: /comp1841/index.php');
exit;
?>
<link rel="stylesheet" href="../css/style.css">