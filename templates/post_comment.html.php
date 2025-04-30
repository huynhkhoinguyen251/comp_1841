<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Comment</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Add a Comment</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="alert error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form action="../post/post_comment.php" method="POST" class="comment-form">
            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post_id) ?>">
            
            <div class="form-group">
                <label>Commenting as:</label>
                <div class="user-info">
                    <i class="fas fa-user"></i> <?= htmlspecialchars($username) ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="content">Your Comment:</label>
                <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Post Comment</button>
                <a href="../post/post.php?id=<?= htmlspecialchars($post_id) ?>" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
