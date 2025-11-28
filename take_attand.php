<?php
//  student list
$student_file = "students.json";

// Load students
if (!file_exists($student_file)) {
    die("Error: students.json file not found. Add students first.");
}

$students = json_decode(file_get_contents($student_file), true);

// Today attendance file name
$today = date("Y-m-d");
$attendance_file = "attendance_" . $today . ".json";

// If attendance has already been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Checking if today's file already exists
    if (file_exists($attendance_file)) {
        echo "<h3>Attendance for today has already been taken.</h3>";
        exit;
    }

    // Building attendance array
    $attendance = [];

    foreach ($students as $student) {
        $id = $student['student_id'];
        $status = $_POST["status_$id"] ?? "absent";

        $attendance[] = [
            "student_id" => $id,
            "status" => $status
        ];
    }

    // Save to JSON
    file_put_contents($attendance_file, json_encode($attendance, JSON_PRETTY_PRINT));

    echo "<h3>Attendance saved successfully for $today.</h3>";
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Take Attendance</title>
</head>
<body>

<h2>Take Attendance — <?php echo $today; ?></h2>

<?php
//  If today's attendance file already exists 
if (file_exists($attendance_file)) {
    echo "<h3>Attendance for today has already been taken.</h3>";
    exit;
}
?>

<form method="POST">

<table border="1" cellpadding="8">
    <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Status</th>
    </tr>

    <?php foreach ($students as $student): ?>
    <tr>
        <td><?php echo $student["student_id"]; ?></td>
        <td><?php echo $student["name"]; ?></td>
        <td>
            <label>
                <input type="radio" name="status_<?php echo $student['student_id']; ?>" value="present" checked>
                Present
            </label>
            <label>
                <input type="radio" name="status_<?php echo $student['student_id']; ?>" value="absent">
                Absent
            </label>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

<br>
<button type="submit">Save Attendance</button>

</form>

</body>
</html>
