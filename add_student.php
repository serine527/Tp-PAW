<?php
require 'db.php';

$sid = $_POST['sid'] ?? '';
$lname = $_POST['lname'] ?? '';
$fname = $_POST['fname'] ?? '';
$email = $_POST['email'] ?? '';

if (empty($sid) || empty($lname) || empty($fname)) {
    echo "Please fill all required fields.";
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO students (sid, lname, fname, email) VALUES (?, ?, ?, ?)");
    $stmt->execute([$sid, $lname, $fname, $email]);
    echo "Student added successfully.";
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // duplicate sid
        echo "A student with this ID already exists.";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
?>
