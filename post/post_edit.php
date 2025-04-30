<?php
require '../config/database_function.php';
require '../header.php';

// Ensure user is logged in
requireLogin();

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: /comp1841/index.php');
    exit;
}

// Fetch existing post
$post = getPostById($pdo, $id);
if (!$post) {
    echo "Post not found";
    exit;
}

// Check permissions - only post owner or admin can edit
if (!isAdmin() && $post['user_id'] != $_SESSION['user_id']) {
    // Not the post owner or admin - redirect to home
    header('Location: /comp1841/index.php?error=permission');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle new image upload if any
    $imagePath = $post['image'];
    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fname = uniqid() . "." . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/$fname");
        $imagePath = $fname;
    }
    
    // Keep the original author, don't allow changing it
    $user_id = $post['user_id'];
    
    updatePost($pdo, $id, $_POST['title'], $_POST['content'], $user_id, $_POST['module_id'], $imagePath);
    header('Location: /comp1841/index.php');
    exit;
}

// Only fetch modules for dropdown
$modules = getModules($pdo);

require '../templates/post_edit.html.php';
require '../footer.php';
?>
<link rel="stylesheet" href="../css/style.css">