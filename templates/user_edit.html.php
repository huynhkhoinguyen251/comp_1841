<h2>Edit User</h2>
<form method="post" novalidate>
  <label>Username</label>
  <input name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

  <label>Email</label>
  <input name="email" type="email" value="<?= htmlspecialchars($user['email']) ?>" required>
  <label>Password <small>(leave blank to keep current)</small></label>
  <input name="password" type="password">

  <label>Role</label>
  <select name="role" required>
    <option value="user"  <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
  </select>

  <button>Update User</button>
</form>