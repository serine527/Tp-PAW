<?php
require 'db(Final_version).php';

// Get POST data
$sid   = $_POST['sid'] ?? '';
$lname = $_POST['lname'] ?? '';
$fname = $_POST['fname'] ?? '';
$email = $_POST['email'] ?? '';

// Basic validation
if (empty($sid)) {
    echo "Student ID is required.";
    exit;
}

try {
    // Check if student exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM students WHERE sid = ?");
    $stmt->execute([$sid]);
    if ($stmt->fetchColumn() == 0) {
        echo "Student not found.";
        exit;
    }

    // Update student info
    $stmt = $pdo->prepare("UPDATE students SET lname = ?, fname = ?, email = ? WHERE sid = ?");
    $stmt->execute([$lname, $fname, $email, $sid]);

    echo "Student updated successfully.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
