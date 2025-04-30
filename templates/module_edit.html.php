<h2>Edit Module</h2>
<form method="post">
  <label>Module Name</label>
  <input name="name" value="<?= htmlspecialchars($module['name']) ?>" required>
  <button class="btn btn-edit"><i class="fas fa-save"></i> Update Module</button>
</form>