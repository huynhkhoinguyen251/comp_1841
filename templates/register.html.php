<h2>Register</h2>

<?php if ($error): ?>
    <div class="error"><?= $error ?></div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="success"><?= $success ?></div>
    <p>You can <a href="/comp1841/login.php">login here</a>.</p>
<?php endif; ?>

<?php if (!$success): ?>
<form method="post" action="/comp1841/register.php">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <small>Must be at least 6 characters long</small>
    </div>
    <div>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    <div>
        <button type="submit" class="btn"><i class="fas fa-user-plus"></i> Register</button>
    </div>
</form>
<?php endif; ?> 