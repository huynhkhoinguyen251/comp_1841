<h2>Login</h2>

<?php if ($error): ?>
    <div class="error"><?= $error ?></div>
<?php endif; ?>

<form method="post" action="/comp1841/login.php">
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i> Login</button>
    </div>
</form>

<p>Don't have an account? <a href="/comp1841/register.php">Register here</a>.</p> 