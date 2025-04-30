<h2>Manage Users</h2>
<p style="text-align: right;"><a href="user_create.php" class="btn add-user"><i class="fas fa-user-plus"></i> New User</a></p>
<table>
  <tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Actions</th></tr>
  <?php foreach ($users as $u): ?>
  <tr>
    <td><?= $u['id'] ?></td>
    <td><?= htmlspecialchars($u['username']) ?></td>
    <td><?= htmlspecialchars($u['email']) ?></td>
    <td><?= $u['role'] ?></td>
    <td>
      <a href="/comp1841/user/user_edit.php?id=<?= $u['id'] ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
      <a href="/comp1841/user/user_delete.php?id=<?= $u['id'] ?>" onclick="return confirm('Delete this user?')" class="btn btn-delete"><i class="fas fa-trash-alt"></i> Delete</a>
      <a href="/comp1841/user/user_reply.php?user_id=<?= $u['id'] ?>" class="btn btn-details"><i class="fas fa-envelope"></i> Email</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>