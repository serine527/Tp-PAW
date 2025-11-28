<?php
require "db_connect.php";

$conn = db_connect();
if (!$conn) {
    die("Connection failed");
}

// Get POST data
$id = $_POST['id'] ?? '';
$fullname = $_POST['fullname'] ?? '';
$matricule = $_POST['matricule'] ?? '';
$group_id = $_POST['group_id'] ?? '';

if (!$id || !$fullname || !$matricule || !$group_id) {
    die("All fields are required");
}

try {
    $stmt = $conn->prepare("UPDATE students SET fullname = ?, matricule = ?, group_id = ? WHERE id = ?");
    $stmt->execute([$fullname, $matricule, $group_id, $id]);
    echo "Student updated successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
