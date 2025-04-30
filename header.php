<?php
// Initialize session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get helper functions for auth
require_once __DIR__ . '/config/database_function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>STUDYSTACK</title>
  <link rel="stylesheet" href="/comp1841/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
  <header>
    <h1><a href="\comp1841\index.php">STUDYSTACK</a></h1>
    <nav>
       <a href="\comp1841\index.php"><i class="fas fa-home"></i> Posts</a>|
       <?php if (isAdmin()): ?>
       <a href="\comp1841\user\users.php"><i class="fas fa-users"></i> Users</a>|
       <a href="\comp1841\modules\modules.php"><i class="fas fa-book"></i> Modules</a>|
       <a href="\comp1841\user\user_reply.php"><i class="fas fa-paper-plane"></i> Send Email</a>
       <?php else: ?>
       <a href="\comp1841\contact.php"><i class="fas fa-envelope"></i> Contact</a>
       <?php endif; ?>
       
       <div style="float: right;">
       <?php if (isset($_SESSION['user_id'])): ?>
       <span><i class="fas fa-user"></i> Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
       <?php if (isAdmin()): ?>
       <span style="color: #ffc107;"><i class="fas fa-crown"></i> Admin</span>
       <?php endif; ?>
       | <a href="\comp1841\logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
       <?php else: ?>
       <a href="\comp1841\login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
       | <a href="\comp1841\register.php"><i class="fas fa-user-plus"></i> Register</a>
       <?php endif; ?>
       </div>
    </nav>
  </header>
  <main>