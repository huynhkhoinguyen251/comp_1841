<?php
require 'config/database_function.php';
require 'Mailer.php';

// Redirect admins away from the contact page
if (isAdmin()) {
    header('Location: /comp1841/index.php');
    exit;
}

$sent = false;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get module name if a module was selected
        $moduleName = 'General Inquiry';
        if (!empty($_POST['module_id'])) {
            $moduleName = getModuleNameById($pdo, $_POST['module_id']);
        }
        
        $mailer = new Mailer();
        $mailer->setTo('nguyenhkgcs230231@fpt.edu.vn', 'Admin')
               ->setFrom(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL), htmlspecialchars($_POST['name']))
               ->setSubject(htmlspecialchars($moduleName))
               ->setHtml(true)
               ->setMessage(
                   "<h3>New Contact Form Submission</h3>" .
                   "<p><strong>Name:</strong> " . htmlspecialchars($_POST['name']) . "</p>" .
                   "<p><strong>Email:</strong> " . htmlspecialchars($_POST['email']) . "</p>" .
                   "<p><strong>Module:</strong> " . htmlspecialchars($moduleName) . "</p>" .
                   "<p><strong>Message:</strong></p>" .
                   "<p>" . nl2br(htmlspecialchars($_POST['message'])) . "</p>"
               );
        
        $mailer->send();
        $sent = true;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Get modules for the dropdown
$modules = getModules($pdo);

require 'header.php';
require 'templates/contact.html.php';
require 'footer.php';
?>
<link rel="stylesheet" href="css/style.css">