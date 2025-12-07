<?php
// db.php - centralized database connection
$host = 'localhost';
$db   = 'attendance_db';
$user = 'root';   
$pass = '';       
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //Makes PDO throw exceptions on errors instead of failing silently
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,//associative arrays when fetching
    PDO::ATTR_EMULATE_PREPARES   => false,//Uses real prepared statements for security and performance.
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
