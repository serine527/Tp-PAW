<?php
require 'db(Final_version).php';

// Expecting JSON from frontend
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !is_array($data)) {
    echo "Invalid attendance data.";
    exit;
}

try {
    // Prepare insert statement
    $stmt = $pdo->prepare("INSERT INTO attendance (sid, session, present, participation) VALUES (?, ?, ?, ?)");

    foreach ($data as $record) {
        $sid = $record['sid'] ?? '';
        $session = $record['session'] ?? 1; // default session 1 if missing
        $present = !empty($record['present']) ? 1 : 0;
        $participation = !empty($record['participation']) ? 1 : 0;

        if ($sid !== '') {
            $stmt->execute([$sid, $session, $present, $participation]);
        }
    }

    echo "Attendance recorded successfully.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
