<h2>All Questions</h2>
<?php if (isLoggedIn()): ?>
<p style="text-align: right;"><a class="btn add-question" href="/comp1841/post/post_create.php"><i class="fas fa-plus-circle"></i> Add New Question</a></p>
<?php endif; ?>

<table>
  <tr>
    <th>ID</th>
    <th>Image</th>
    <th>Title</th>
    <th>Content</th>
    <th>Module</th>
    <th>Author</th>
    <th>Actions</th>
  </tr>
  <?php foreach ($posts as $post): ?>
  <tr>
    <td><?= htmlspecialchars($post['id']) ?></td>
    <td>
      <?php if (!empty($post['image'])): ?>
        <img src="uploads/<?= htmlspecialchars($post['image']) ?>"
             alt="Image for <?= htmlspecialchars($post['title']) ?>"
             style="max-width:100px; height:auto; border-radius:4px;">
      <?php else: ?>
        —  
      <?php endif; ?>
    </td>
    <td><?= htmlspecialchars($post['title']) ?></td>
    <td><?= htmlspecialchars($post['content']) ?></td>
    <td><?= htmlspecialchars($post['module_name']) ?></td>
    <td><?= htmlspecialchars($post['username']) ?></td>
    <td>
      <?php if (isAdmin() || (isset($_SESSION['user_id']) && $post['user_id'] == $_SESSION['user_id'])): ?>
      <a href="/comp1841/post/post_edit.php?id=<?= $post['id'] ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
      <?php endif; ?>
      
      <?php if (isAdmin()): ?>
      <a href="/comp1841/post/post_delete.php?id=<?= $post['id'] ?>"
         onclick="return confirm('Are you sure you want to delete this post?')" class="btn btn-delete"><i class="fas fa-trash-alt"></i> Delete</a>
      <?php endif; ?>
      
      <a href="/comp1841/post/post.php?id=<?= $post['id'] ?>" class="btn btn-comment"><i class="fas fa-info-circle"></i> Details</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>