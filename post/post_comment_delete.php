<?php
require '../config/database_function.php';
require '../header.php';

// Ensure user is logged in
requireLogin();

// Get comment ID from URL
$comment_id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : null;

// Initialize variables for success/error messages
$success = null;
$error = null;

// Redirect to index if no comment ID is provided
if (empty($comment_id)) {
    header('Location: ../index.php');
    exit;
}

// Get the comment details to determine which post it belongs to
$comment = getCommentById($pdo, $comment_id);

// If comment doesn't exist, redirect to index
if (!$comment) {
    header('Location: ../index.php');
    exit;
}

// Store the post_id to redirect back after deletion
$post_id = $comment['post_id'];

// Check permissions - only comment author or admin can delete
if (!isAdmin() && $comment['user_id'] != $_SESSION['user_id']) {
    // Not authorized to delete this comment
    header("Location: ../post/post.php?id=$post_id&error=permission");
    exit;
}

// Process deletion if confirmed
if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    try {
        $deleted = deleteComment($pdo, $comment_id);
        if ($deleted) {
            // Redirect back to post page with success message
            header("Location: ../post/post.php?id=$post_id&delete_success=1");
            exit;
        } else {
            $error = "Failed to delete comment. It may have already been deleted.";
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}

?>

<div class="container">
    <h1>Delete Comment</h1>
    
    <?php if ($error): ?>
        <div class="alert error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    
    <div class="confirmation-box">
        <p>Are you sure you want to delete this comment?</p>
        <div class="comment">
            <div class="comment-content">
                <p><?= htmlspecialchars($comment['content']) ?></p>
            </div>
        </div>
        <div class="actions">
            <a href="post_comment_delete.php?id=<?= $comment_id ?>&confirm=yes" class="btn btn-delete"><i class="fas fa-trash-alt"></i> Yes, Delete</a>
            <a href="../post/post.php?id=<?= $post_id ?>" class="btn"><i class="fas fa-times"></i> Cancel</a>
        </div>
    </div>
</div>

<?php require '../footer.php'; ?> 