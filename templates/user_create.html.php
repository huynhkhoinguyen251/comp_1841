<h2>New User</h2>
<form method="post">
  <label>Username</label>
  <input name="username" required minlength="3">

  <label>Email</label>
  <input name="email" type="email" required>

  <label>Password</label>
  <input name="password" type="password" required minlength="6">

  <label>Role</label>
  <select name="role" required>
    <option value="User">User</option>
    <option value="Admin">Admin</option>
  </select>

  <button>Create User</button>
</form>