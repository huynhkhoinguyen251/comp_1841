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