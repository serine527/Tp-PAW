<?php
require 'db(Final_version).php';

$stmt = $pdo->query("SELECT sid, lname, fname, email FROM students ORDER BY lname ASC");//runs a SQL query
$students = $stmt->fetchAll();

echo json_encode($students);//Convert the data to JSON
?>
