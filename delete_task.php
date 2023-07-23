<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["taskID"]) && isset($_POST["listID"])) {
        $taskID = intval($_POST["taskID"]);
        $listID = intval($_POST["listID"]);
        require_once("db.php");
        $query = "DELETE FROM tasks WHERE taskID = $taskID AND listID = $listID";
        $result = $conn->query($query);

        if ($result) {
            echo "Task deleted successfully";
        } else {
            echo "Error deleting the task: " . $conn->error;
        }
    } else {
        echo "Invalid request";
    }
}
