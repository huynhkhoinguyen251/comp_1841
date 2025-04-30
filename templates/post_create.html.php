<h2>New Question</h2>
<form method="post" enctype="multipart/form-data">
  <label>Title</label>
  <input name="title" required>

  <label>Content</label>
  <textarea name="content" rows="5" required></textarea>

  <label>Author</label>
  <div class="user-info">
    <i class="fas fa-user"></i> <?= htmlspecialchars($username) ?>
  </div>

  <label>Module</label>
  <select name="module_id" required>
    <option value="">— Select —</option>
    <?php foreach ($modules as $m): ?>
      <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['name']) ?></option>
    <?php endforeach; ?>
  </select>

  <label>Image (optional)</label>
  <input type="file" name="image" accept="image/*">

  <button type="submit" class="btn"><i class="fas fa-plus-circle"></i> Post Question</button>
</form>