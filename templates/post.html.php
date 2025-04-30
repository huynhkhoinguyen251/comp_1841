<div class="container">
    <?php if ($post): ?>
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        
        <?php if (!empty($post['image'])): ?>
            <div class="post-image">
                <img src="../uploads/<?= htmlspecialchars($post['image']) ?>" 
                     alt="Image for <?= htmlspecialchars($post['title']) ?>"
                     style="max-width:100%; height:auto; border-radius:4px; margin-bottom:20px;">
            </div>
        <?php endif; ?>
        
        <div class="post-content">
            <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        </div>
        
        <div class="post-meta">
            <p> 
                <strong>Posted:</strong> <?= htmlspecialchars($post['created_at']) ?>
                <?php if (!empty($post['username'])): ?>
                    by <strong><?= htmlspecialchars($post['username']) ?></strong>
                <?php endif; ?>
                <?php if (!empty($post['module_name'])): ?>
                    in <strong><?= htmlspecialchars($post['module_name']) ?></strong>
                <?php endif; ?>
            </p>
        </div>
        
        <div class="post-actions">
            <a href="/comp1841/index.php" class="btn"><i class="fas fa-arrow-left"></i> Back to Questions</a>
            <?php if (isLoggedIn() && (isAdmin() || $post['user_id'] == $_SESSION['user_id'])): ?>
                <a href="post_edit.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit Post</a>
                <a href="post_delete.php?id=<?php echo $post['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this post?');">Delete Post</a>
            <?php endif; ?>
            <?php if (isLoggedIn()): ?>
            <a href="/comp1841/post/post_comment.php?post_id=<?= $post['id'] ?>" class="btn btn-comment"><i class="fas fa-comment"></i> Add Comment</a>
            <?php endif; ?>
        </div>
        
        <!-- Comments Section -->
        <div class="comments-section">
            <h2>Comments</h2>
            
            <?php if ($delete_success): ?>
                <div class="alert success">
                    Comment has been successfully deleted.
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['error']) && $_GET['error'] === 'permission'): ?>
                <div class="alert error">
                    You don't have permission to perform that action.
                </div>
            <?php endif; ?>
            
            <?php if (empty($comments)): ?>
                <p class="no-comments">No comments yet. Be the first to comment!</p>
            <?php else: ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <div class="comment-author">
                            <strong><?= htmlspecialchars($comment['username']) ?></strong> 
                        </div>
                        <div class="comment-content">
                            <p><?= htmlspecialchars($comment['content']) ?></p>
                        </div>
                        <?php if (isAdmin() || (isLoggedIn() && $comment['user_id'] == $_SESSION['user_id'])): ?>
                        <div class="comment-actions">
                            <a href="/comp1841/post/post_comment_delete.php?id=<?= $comment['id'] ?>" class="btn-delete btn-sm"><i class="fas fa-trash-alt"></i> Delete</a>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
    <?php else: ?>
        <p>Post not found. <a href="/comp1841/index.php">Return to questions list</a></p>
    <?php endif; ?>
</div> 