<?php
require '../config/database_function.php';

// Get post ID from URL
$post_id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : null;

// Redirect to index if no post ID is provided
if (empty($post_id)) {
    header('Location: ../index.php');
    exit;
}

// Check for success message
$delete_success = isset($_GET['delete_success']) ? true : false;

// Get post details
$post = getPostById($pdo, $post_id);

// Get comments for this post
$comments = getCommentsByPostId($pdo, $post_id);

// Get users for comment form dropdown
$users = getUsersForDropdown($pdo);

// Include templates
require '../header.php';
require '../templates/post.html.php';
require '../footer.php';
?> 