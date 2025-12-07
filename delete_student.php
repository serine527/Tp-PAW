<?php
require 'db(Final_version).php';

// Get POST data
$sid = $_POST['sid'] ?? '';

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

    
    $stmt = $pdo->prepare("DELETE FROM students WHERE sid = ?");
    $stmt->execute([$sid]);

    echo "Student deleted successfully.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
