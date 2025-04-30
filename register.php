<?php
require 'config/database_function.php';
require 'header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validate input
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'All fields are required';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long';
    } else {
        // Check if email already exists
        $existingUser = getUserByEmail($pdo, $email);
        if ($existingUser) {
            $error = 'Email address is already registered';
        } else {
            // Create new user with 'user' role
            createUser($pdo, $username, $email, $password, 'user');
            $success = 'Registration successful! You can now log in.';
            
            // Optionally auto-login the user
            // $user = getUserByEmail($pdo, $email);
            // $_SESSION['user_id'] = $user['id'];
            // $_SESSION['username'] = $user['username'];
            // $_SESSION['role'] = $user['role'];
            // header('Location: /comp1841/index.php');
            // exit;
        }
    }
}

require 'templates/register.html.php';
require 'footer.php';
?> 