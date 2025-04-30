<h2>Manage Modules</h2>
<p style="text-align: right;"><a href="module_create.php" class="btn add-module"><i class="fas fa-plus-circle"></i> New Module</a></p>
<table class="module-table">
  <tr><th>ID</th><th>Name</th><th>Actions</th></tr>
  <?php foreach ($modules as $m): ?>
  <tr>
    <td><?= $m['id'] ?></td>
    <td><?= htmlspecialchars($m['name']) ?></td>
    <td>
      <a href="module_edit.php?id=<?= $m['id'] ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
      <a href="module_delete.php?id=<?= $m['id'] ?>" onclick="return confirm('Delete?')" class="btn btn-delete"><i class="fas fa-trash-alt"></i> Delete</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>