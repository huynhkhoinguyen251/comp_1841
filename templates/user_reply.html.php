<h2>Send Message To User</h2>

<?php if ($sent): ?>
    <div class="alert success">
        <p>Your message has been sent successfully to <?= htmlspecialchars($user['username']) ?> (<?= htmlspecialchars($user['email']) ?>).</p>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert error">
        <p>Error: <?= htmlspecialchars($error) ?></p>
    </div>
<?php endif; ?>

<?php if (!$user && !isset($_GET['user_id'])): ?>
    <form method="get">
        <label>Select User</label>
        <select name="user_id" required>
            <option value="">Select user...</option>
            <?php foreach ($users as $u): ?>
                <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['username']) ?> (<?= htmlspecialchars($u['email']) ?>)</option>
            <?php endforeach; ?>
        </select>
        <button>Select</button>
    </form>
<?php elseif ($user): ?>
    <form method="post">
        <p>
            <strong>Send to:</strong> <?= htmlspecialchars($user['username']) ?> (<?= htmlspecialchars($user['email']) ?>)
        </p>

        <label>Subject</label>
        <input name="subject" value="<?= isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : 'Message From Forum' ?>" required>

        <label>Content</label>
        <textarea name="message" rows="10" required><?= isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '' ?></textarea>

        <button>Send Message</button>
        <a href="?">Back to select user</a>
    </form>
<?php endif; ?>

