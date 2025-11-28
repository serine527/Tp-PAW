
<?php
//  Get form data
$student_id = $_POST['student_id'] ?? '';
$name       = $_POST['name'] ?? '';
$group      = $_POST['group'] ?? '';

//  Validate fields
$errors = [];

if (empty($student_id)) { $errors[] = "Student ID is required."; }
if (empty($name)) { $errors[] = "Name is required."; }
if (empty($group)) { $errors[] = "Group is required."; }

// Stop if there are validation errors
if (!empty($errors)) {
    echo "<h3>Error:</h3><ul>";
    foreach ($errors as $e) {
        echo "<li>$e</li>";
    }
    echo "</ul>";
    exit;
}

//  Load existing students
$filename = "students.json";

if (file_exists($filename)) {
    $json_data = file_get_contents($filename);
    $students = json_decode($json_data, true);
} else {
    $students = [];
}

//  Add the new student
$new_student = [
    "student_id" => $student_id,
    "name"       => $name,
    "group"      => $group
];

$students[] = $new_student;

//  Save back to students.json
file_put_contents($filename, json_encode($students, JSON_PRETTY_PRINT));

//  Display confirmation message
echo "<h3>Student added successfully!</h3>";
echo "<p><strong>ID:</strong> $student_id</p>";
echo "<p><strong>Name:</strong> $name</p>";
echo "<p><strong>Group:</strong> $group</p>";

?>
