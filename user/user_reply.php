<?php
require '../config/database_function.php';
require '../header.php';
require '../Mailer.php';

// Require admin privileges
requireAdmin();

$sent = false;
$error = null;
$user = null;

// Fetch user if ID is provided
if (isset($_GET['user_id'])) {
    $user = getUserById($pdo, $_GET['user_id']);
    if (!$user) {
        $error = "User not found";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user) {
    try {
        // Create HTML email content
        $htmlMessage = nl2br(htmlspecialchars($_POST['message']));
        $message = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
            <h2 style='color: #444;'>Message From Forum</h2>
            <div style='padding: 15px; background-color: #f5f5f5; border-radius: 5px;'>
                $htmlMessage
            </div>
            <p style='color: #777; font-size: 12px; margin-top: 20px;'>
                This email was sent from Forum of Khoi Nguyen.
            </p>
        </div>";

        // Send email
        Mailer::sendEmail(
            $user['email'],
            $user['username'],
            htmlspecialchars($_POST['subject']),
            $message
        );

        $sent = true;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Fetch users for dropdown if no user is selected
$users = !$user && !isset($_GET['user_id']) ? getUsersForDropdown($pdo) : [];

require '../templates/user_reply.html.php';
require '../footer.php';
?>
<link rel="stylesheet" href="../css/style.css">