<?php
require '../config/database_function.php';
require '../header.php';

// Require login to comment
requireLogin();

// Initialize variables
$errors = [];

// Get post_id from URL parameter
$post_id = isset($_GET['post_id']) ? filter_var($_GET['post_id'], FILTER_SANITIZE_NUMBER_INT) : null;

// If post_id not in URL, check POST data (for form submissions)
if (!$post_id && isset($_POST['post_id'])) {
    $post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
}

// Redirect to index if no post_id is provided
if (empty($post_id)) {
    header('Location: ../index.php');
    exit;
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the current logged-in user ID from session
    $user_id = $_SESSION['user_id'] ?? null;
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    
    // Validation
    if (empty($post_id)) {
        $errors[] = "Post ID is required";
    }
    
    if (empty($user_id)) {
        $errors[] = "You must be logged in to comment";
    }
    
    if (empty($content)) {
        $errors[] = "Comment content is required";
    }
    
    // If no errors, save the comment
    if (empty($errors)) {
        try {
            createComment($pdo, $post_id, $user_id, $content);
            // Redirect back to the post page after successful comment
            header("Location: ../post/post.php?id=$post_id");
            exit;
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}

// Get the user's information for display
$username = $_SESSION['username'] ?? 'Unknown';

require '../templates/post_comment.html.php';
require '../footer.php';
?>