<?php
require "db_connect.php";

$conn = db_connect();
if (!$conn) {
    die("Connection failed");
}

try {
    $stmt = $conn->query("SELECT * FROM students");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($students);
    echo "</pre>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
