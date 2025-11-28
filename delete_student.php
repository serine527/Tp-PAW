<?php
require "db_connect.php";

$conn = db_connect();
if (!$conn) {
    die("Connection failed");
}

$id = $_POST['id'] ?? '';

if (!$id) {
    die("Student ID is required");
}

try {
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
    echo "Student deleted successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
