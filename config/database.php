<?php
// db.php
$host     = '127.0.0.1';
$dbname   = 'comp1841';    // your database name
$user     = 'root';        // adjust if needed
$password = '';            // adjust if needed
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
  $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
  echo "<h1>Database Connection Error</h1>";
  echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
  exit;
}