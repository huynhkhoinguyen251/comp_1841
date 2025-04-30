<?php
require 'config/database_function.php';
require 'header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = 'Email and password are required';
    } else {
        $user = getUserByEmail($pdo, $email);
        
        if ($user && password_verify($password, $user['password'])) {
            // Start the session and store user information
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            // Redirect to home page
            header('Location: /comp1841/index.php');
            exit;
        } else {
            $error = 'Invalid email or password';
        }
    }
}

require 'templates/login.html.php';
require 'footer.php';
?> 