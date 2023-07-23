<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("db.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listID']) && isset($_POST['taskID']) && isset($_POST['done'])) {
    $listID = intval($_POST['listID']);
    $taskID = intval($_POST['taskID']);
    $done = intval($_POST['done']);
    $updateQuery = "UPDATE `tasks` SET `done` = $done WHERE `listID` = $listID AND `taskID` = $taskID";
    $result = $conn->query($updateQuery);
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating task status']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
