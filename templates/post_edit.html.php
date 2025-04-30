<h2>Edit Question</h2>
<form method="post" enctype="multipart/form-data">
  <label>Title</label>
  <input name="title" value="<?= htmlspecialchars($post['title']) ?>" required>

  <label>Content</label>
  <textarea name="content" rows="5" required><?= htmlspecialchars($post['content']) ?></textarea>

  <label>Author</label>
  <div class="user-info">
    <i class="fas fa-user"></i> <?= htmlspecialchars($post['username']) ?>
  </div>

  <label>Module</label>
  <select name="module_id" required>
    <?php foreach ($modules as $m): ?>
      <option value="<?= $m['id'] ?>"
        <?= $post['module_id'] == $m['id'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($m['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label>Current Image</label>
  <?php if ($post['image']): ?>
    <img src="../uploads/<?= htmlspecialchars($post['image']) ?>" style="max-width:200px;">
  <?php else: ?>
    <p>No image uploaded.</p>
  <?php endif; ?>

  <label>Replace Image</label>
  <input type="file" name="image" accept="image/*">

  <button type="submit" class="btn btn-edit"><i class="fas fa-save"></i> Update Question</button>
</form>