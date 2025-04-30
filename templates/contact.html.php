<h2>Contact Administrator</h2>

<?php if ($sent): ?>
    <div class="alert success">
        <p>Your message has been sent successfully.</p>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert error">
        <p>Error: <?= htmlspecialchars($error) ?></p>
    </div>
<?php endif; ?>

<form method="post">
    <label>Your Name</label>
    <input name="name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" required>

    <label>Your Email</label>
    <input name="email" type="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>

    <label>Module</label>
    <select name="module_id" required>
        <option value="">— Select —</option>
        <?php foreach ($modules as $m): ?>
            <option value="<?= $m['id'] ?>" <?= isset($_POST['module_id']) && $_POST['module_id'] == $m['id'] ? 'selected' : '' ?>><?= htmlspecialchars($m['name']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Message</label>
    <textarea name="message" rows="6" required><?= isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '' ?></textarea>

    <button>Send Message</button>
</form>