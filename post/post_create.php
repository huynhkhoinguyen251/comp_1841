<?php
require '../config/database_function.php';
require '../header.php'; 

// Require login to create posts
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // handle file upload if any
    $imagePath = null;
    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fname = uniqid() . "." . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/$fname");
        $imagePath = $fname;
    }

    // Use the logged-in user's ID instead of form input
    $user_id = $_SESSION['user_id'];
    
    createPost($pdo, $_POST['title'], $_POST['content'], $user_id, $_POST['module_id'], $imagePath);
    header('Location: /comp1841/index.php');
    exit;
}

// fetch modules for dropdown (no need for users dropdown anymore)
$modules = getModules($pdo);

// Get the current user's username for display
$username = $_SESSION['username'] ?? 'Unknown';

require '../templates/post_create.html.php';
require '../footer.php';
?>
<link rel="stylesheet" href="../css/style.css">