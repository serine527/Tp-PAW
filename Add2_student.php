<?php
require "db_connect.php";

$conn = db_connect();
if (!$conn) {
    die("Connection failed");
}

// Get POST data
$fullname = $_POST['fullname'] ?? '';
$matricule = $_POST['matricule'] ?? '';
$group_id = $_POST['group_id'] ?? '';

//  validation
if (!$fullname || !$matricule || !$group_id) {
    die("All fields are required");
}

try {
    $stmt = $conn->prepare("INSERT INTO students (fullname, matricule, group_id) VALUES (?, ?, ?)");
    $stmt->execute([$fullname, $matricule, $group_id]);
    echo "Student added successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
